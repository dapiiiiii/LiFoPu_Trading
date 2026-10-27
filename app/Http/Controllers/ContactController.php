<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Mail\InquiryConfirmation;
use App\Mail\InquiryReceived;
use App\Models\Inquiry;
use App\Support\Turnstile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    public function show(Request $request, Turnstile $turnstile): View
    {
        $interest = $request->query('interest');

        return view('pages.contact', [
            'started' => Crypt::encryptString((string) now()->timestamp),
            'preset' => in_array($interest, Inquiry::INTERESTS, true) ? $interest : null,
            'turnstileKey' => $turnstile->enabled() ? config('lifopu.turnstile.site_key') : null,
        ]);
    }

    public function store(InquiryRequest $request): JsonResponse|RedirectResponse
    {
        try {
            $inquiry = Inquiry::create([
                ...$request->safe()->only(['interest', 'name', 'organization', 'email', 'phone', 'subject', 'message']),
                'details' => $request->details() ?: null,
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 255),
            ]);
        } catch (Throwable $e) {
            report($e);

            return $this->respond($request, false, __('contact.result.error'), 500);
        }

        // The inquiry is stored at this point, so the team can always find it.
        // Notification failures are logged and can be retried with `php artisan inquiries:notify`.
        try {
            Mail::to(config('lifopu.inquiries.to'))->send(new InquiryReceived($inquiry));

            if (config('lifopu.inquiries.send_confirmation')) {
                Mail::to($inquiry->email)->send(new InquiryConfirmation($inquiry));
            }

            $inquiry->forceFill(['mailed_at' => now()])->save();
        } catch (Throwable $e) {
            report($e);
        }

        $message = __('contact.result.success', [
            'name' => $inquiry->name,
            'ref' => $inquiry->reference,
            'email' => $inquiry->email,
        ]);

        return $this->respond($request, true, $message, 201, ['reference' => $inquiry->reference]);
    }

    private function respond(Request $request, bool $ok, string $message, int $status, array $extra = []): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json(['ok' => $ok, 'message' => $message, ...$extra], $status);
        }

        return redirect()
            ->route('contact')
            ->with('inquiry', ['ok' => $ok, 'message' => $message, ...$extra])
            ->withInput($ok ? [] : $request->except('_started'));
    }
}
