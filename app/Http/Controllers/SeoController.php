<?php

namespace App\Http\Controllers;

use App\Support\ServiceLink;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $urls = collect(['home', 'about', 'services', 'markets', 'sustainability', 'contact', 'privacy'])
            ->map(fn (string $name) => route($name))
            ->merge(collect(ServiceLink::internal())->map(fn (string $slug) => route('services.show', $slug)));

        return response()
            ->view('seo.sitemap', ['urls' => $urls, 'updated' => now()->toDateString()])
            ->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $body = "User-agent: *\nAllow: /\n\nSitemap: ".route('sitemap')."\n";

        return response($body)->header('Content-Type', 'text/plain');
    }
}
