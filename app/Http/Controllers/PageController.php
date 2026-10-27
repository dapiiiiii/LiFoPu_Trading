<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('pages.services.index');
    }

    public function service(string $service): View
    {
        $slugs = config('lifopu.services');
        $index = array_search($service, $slugs, true);

        return view('pages.services.show', [
            'slug' => $service,
            'item' => trans("services.items.$service"),
            'next' => $slugs[($index + 1) % count($slugs)],
        ]);
    }

    public function markets(): View
    {
        return view('pages.markets');
    }

    public function sustainability(): View
    {
        return view('pages.sustainability');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }
}
