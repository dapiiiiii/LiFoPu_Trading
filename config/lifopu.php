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
        'phone' => '+251 911 502 088',
        'phone_href' => '+251911502088',
        'email' => 'sebhat.tasew@lifopu.com',
    ],

    // Further contact people, listed after the main contact on the contact page.
    'more_contacts' => [
        ['person' => 'Girmay Berhane', 'phone' => '+251 911 615 633', 'phone_href' => '+251911615633'],
    ],

    // Office locations supplied by the company (November 2026). Century Executive Tower is the main office.
    // Coordinates are the Google Maps pins.
    'offices' => [
        'main' => [
            'name' => 'Century Executive Tower',
            'street' => 'Namibia St',
            'city' => 'Addis Ababa',
            'lat' => 9.000688,
            'lng' => 38.782609,
            'map' => 'https://maps.app.goo.gl/5P3tStE5ePjnoNHX8',
        ],
        'branch' => [
            'name' => 'Torhayloch',
            'street' => null,
            'city' => 'Addis Ababa',
            'lat' => 9.014301,
            'lng' => 38.715619,
            'map' => 'https://maps.app.goo.gl/z5mKNs8QCzuToiQP8',
        ],
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
