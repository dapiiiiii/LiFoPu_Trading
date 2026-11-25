<?php

namespace App\Http\Controllers;

use App\Support\ServiceLink;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $aboutSections = ['mission', 'mark', 'history', 'advantage', 'structure', 'future'];
        $urls = collect(['home', 'about', 'services', 'sustainability', 'contact', 'team', 'privacy'])
            ->map(fn (string $name) => route($name))
            ->merge(collect($aboutSections)->map(fn (string $sec) => route('about.section', $sec)))
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
