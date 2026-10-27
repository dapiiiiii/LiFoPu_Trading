<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Optional Cloudflare Turnstile verification. Enabled when
 * TURNSTILE_SITE_KEY and TURNSTILE_SECRET_KEY are set.
 */
class Turnstile
{
    public function enabled(): bool
    {
        return filled(config('lifopu.turnstile.site_key')) && filled(config('lifopu.turnstile.secret_key'));
    }

    public function verify(?string $token, ?string $ip): bool
    {
        if (blank($token)) {
            return false;
        }

        try {
            $response = Http::asForm()->timeout(8)->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => config('lifopu.turnstile.secret_key'),
                'response' => $token,
                'remoteip' => $ip,
            ]);

            return (bool) $response->json('success');
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }
}
