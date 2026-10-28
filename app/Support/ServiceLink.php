<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

/**
 * Where a service link points: a LiFoPu page, or a sister company's website
 * (config lifopu.external_services).
 */
class ServiceLink
{
    public static function external(string $slug): ?string
    {
        return config("lifopu.external_services.$slug");
    }

    public static function href(string $slug): string
    {
        return self::external($slug) ?? route('services.show', $slug);
    }

    /** Partner websites open in a new tab. */
    public static function attributes(string $slug): HtmlString
    {
        return new HtmlString(self::external($slug) ? 'target="_blank" rel="noopener"' : '');
    }

    /** Visible ↗ plus a screen-reader note that the link leaves the site. */
    public static function marker(string $slug): HtmlString
    {
        $url = self::external($slug);

        if (! $url) {
            return new HtmlString('');
        }

        $site = preg_replace('/^www\./', '', (string) parse_url($url, PHP_URL_HOST));

        return new HtmlString(
            '<span class="ext-mark" aria-hidden="true">↗</span>'
            .'<span class="sr-only"> ('.e(__('common.opens_new_tab', ['site' => $site])).')</span>'
        );
    }

    /** Services that have their own page on this site. */
    public static function internal(): array
    {
        return array_values(array_diff(config('lifopu.services'), array_keys(config('lifopu.external_services'))));
    }
}
