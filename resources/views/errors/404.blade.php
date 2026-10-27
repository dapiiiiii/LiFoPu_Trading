<x-layout title="Page not found — LiFoPu Trading" page="error">

    <section class="page-hero page-hero--dark page-hero--error" data-sky="dawn" aria-labelledby="page-title">
        <div class="page-hero__scene" aria-hidden="true">
            @include('partials.scenes.road-end', ['km' => '404'])
        </div>
        <div class="page-hero__shade" aria-hidden="true"></div>
        <div class="page-hero__content container">
            <p class="eyebrow eyebrow--light">Error 404</p>
            <h1 id="page-title" class="page-hero__title">This road doesn’t go anywhere.</h1>
            <p class="page-hero__lede">The page you were looking for has moved or never existed. Let’s get you back on route.</p>
            <div class="page-hero__actions">
                <a href="{{ route('home') }}" class="btn btn--primary btn--lg">{{ __('common.actions.back_home') }}</a>
                <a href="{{ route('contact') }}" class="btn btn--ghost-light btn--lg">{{ __('common.nav.contact') }}</a>
            </div>
        </div>
    </section>

</x-layout>
