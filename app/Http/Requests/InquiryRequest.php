<?php

namespace App\Http\Requests;

use App\Models\Inquiry;
use App\Support\Turnstile;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class InquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $options = trans('contact.options');

        return [
            'interest' => ['required', Rule::in(Inquiry::INTERESTS)],
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'organization' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'string', 'email:filter', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40', 'regex:/^[0-9+()\-\s.]{7,40}$/'],
            'subject' => ['required', 'string', 'min:3', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'privacy' => ['accepted'],

            'details' => ['nullable', 'array'],
            'details.customer_type' => ['nullable', Rule::in(array_keys($options['customer_type']))],
            'details.volume' => ['nullable', 'string', 'max:120'],
            'details.location' => ['nullable', 'string', 'max:160'],
            'details.origin' => ['nullable', 'string', 'max:160'],
            'details.destination' => ['nullable', 'string', 'max:160'],
            'details.schedule' => ['nullable', 'string', 'max:120'],
            'details.grade' => ['nullable', Rule::in(array_keys($options['grade']))],
            'details.market' => ['nullable', 'string', 'max:120'],
            'details.partner_type' => ['nullable', Rule::in(array_keys($options['partner_type']))],

            // Spam protection: honeypot must stay empty, timestamp must be genuine.
            'website' => ['prohibited'],
            '_started' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return collect(trans('contact.fields'))
            ->only(['name', 'organization', 'email', 'phone', 'subject', 'message'])
            ->put('privacy', __('contact.fields.privacy_link'))
            ->all();
    }

    public function messages(): array
    {
        return [
            'privacy.accepted' => 'Please accept the Privacy Policy so we can respond.',
            'phone.regex' => 'Use digits, spaces and an optional + country code.',
            'website.prohibited' => 'Your submission could not be verified.',
            '_started.required' => 'Your submission could not be verified. Please reload the page.',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->isNotEmpty()) {
                    return;
                }

                try {
                    $started = (int) Crypt::decryptString($this->input('_started'));
                } catch (DecryptException) {
                    $validator->errors()->add('_started', 'Your submission could not be verified. Please reload the page.');

                    return;
                }

                if (now()->timestamp - $started < config('lifopu.inquiries.min_seconds')) {
                    $validator->errors()->add('_started', 'That was very fast. Please take a moment and send again.');

                    return;
                }

                $turnstile = app(Turnstile::class);
                if ($turnstile->enabled() && ! $turnstile->verify($this->input('cf-turnstile-response'), $this->ip())) {
                    $validator->errors()->add('_started', 'Please complete the verification challenge.');
                }
            },
        ];
    }

    /**
     * Interest-specific details, without empty values.
     */
    public function details(): array
    {
        return collect($this->validated('details') ?? [])
            ->filter(fn ($value) => filled($value))
            ->all();
    }
}
