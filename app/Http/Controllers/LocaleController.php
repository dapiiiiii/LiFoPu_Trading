<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Switch language. Locales that are not yet approved stay unavailable.
     */
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        $locales = config('lifopu.locales');

        if (! ($locales[$locale]['ready'] ?? false)) {
            return back()->with('status', __('common.settings.am_note'));
        }

        $request->session()->put('locale', $locale);

        return back();
    }
}
