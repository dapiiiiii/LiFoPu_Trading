<?php

/*
|--------------------------------------------------------------------------
| LiFoPu site configuration
|--------------------------------------------------------------------------
|
| Verified company details come from the LiFoPu Company Profile (2026
| edition). Anything marked "approval" in CONTENT_REGISTER.md must be
| confirmed by the company before launch.
|
*/

return [

    'company' => [
        'name' => 'LiFoPu Trading',
        'group' => 'LiFoPu Trading & Transport',
        'tagline' => 'Live For Purpose.',
        'founded' => '2013-08',
        'country' => 'Ethiopia',
    ],

    // Company Profile 2026, p.10 "Contact Information".
    'contact' => [
        'person' => 'Sebhat Gebrehiwot',
        'role' => 'Founder',
        'phone' => '+251 911 502 088',
        'phone_href' => '+251911502088',
        'email' => 'sebhat.tasew@lifopu.com',
        'address' => null, // Not published in the profile; add once verified.
    ],

    'social' => [
        // Add only approved, company-owned profiles, e.g. 'linkedin' => 'https://...'.
    ],

    'inquiries' => [
        'to' => env('INQUIRY_MAIL_TO', 'sebhat.tasew@lifopu.com'),
        'send_confirmation' => (bool) env('INQUIRY_SEND_CONFIRMATION', true),
        'min_seconds' => 3, // Submissions faster than this are treated as bots.
    ],

    'turnstile' => [
        'site_key' => env('TURNSTILE_SITE_KEY'),
        'secret_key' => env('TURNSTILE_SECRET_KEY'),
    ],

    'locales' => [
        'en' => ['label' => 'English', 'native' => 'English', 'ready' => true],
        // Amharic ships once a professional translation is approved by the company.
        'am' => ['label' => 'Amharic', 'native' => 'አማርኛ', 'ready' => false],
    ],

    'services' => ['fuel-retail', 'lubricants', 'fuel-transportation', 'coffee-export'],

    // Services run by a sister company on its own website. Links open there in a new tab,
    // and the old /services/<slug> address redirects.
    'external_services' => [
        'coffee-export' => 'https://lelatrading.com/', // Lela Trading
    ],

];
