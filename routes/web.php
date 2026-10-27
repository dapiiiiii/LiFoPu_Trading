<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services');
    Route::get('/services/{service}', 'service')
        ->whereIn('service', config('lifopu.services'))
        ->name('services.show');
    Route::get('/markets', 'markets')->name('markets');
    Route::get('/sustainability-safety', 'sustainability')->name('sustainability');
    Route::get('/privacy-policy', 'privacy')->name('privacy');
});

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:inquiries')
    ->name('contact.store');

Route::get('/locale/{locale}', LocaleController::class)->name('locale');

Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
