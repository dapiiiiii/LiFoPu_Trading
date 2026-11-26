@use('App\Support\ServiceLink')
<x-layout :title="__('home.meta_title')" page="home">

    {{-- A. Dawn hero: "The Road Awakens" --}}
    <section class="hero" data-hero data-sky="dawn" data-spine-label="{{ __('common.nav.home') }}" aria-labelledby="hero-title">
        <div class="hero__stage" aria-hidden="true">
            @include('partials.scenes.dawn')
            <canvas class="hero__canvas" data-hero-canvas></canvas>
            <div class="hero__grade"></div>
        </div>
        <div class="hero__intro" aria-hidden="true" data-hero-intro>
            <x-logo variant="mark" title="" :parts="true" class="hero__intro-mark" />
        </div>

        <div class="hero__content container">
            <p class="eyebrow eyebrow--light hero__eyebrow" data-hero-reveal>{{ __('home.hero.eyebrow') }}</p>
            <h1 id="hero-title" class="hero__title">
                <span class="hero__line" data-hero-line><span>{{ __('home.hero.title_a') }}</span></span>
                <span class="hero__line hero__line--light" data-hero-line><span>{{ __('home.hero.title_b') }}</span></span>
            </h1>
            <p class="hero__lede" data-hero-reveal>{{ __('home.hero.lede') }}</p>
            <div class="hero__actions" data-hero-reveal>
                <a href="#capabilities" class="btn btn--primary btn--lg">{{ __('home.hero.cta_primary') }} <span aria-hidden="true">↓</span></a>
                <a href="{{ route('about') }}" class="btn btn--ghost-light btn--lg">{{ __('home.hero.cta_secondary') }}</a>
            </div>
        </div>

        <div class="hero__foot container" aria-hidden="true">
            <span class="hero__est">Est. 2013 · Ethiopia</span>
            <span class="hero__scroll"><span class="hero__scroll-road"><span></span></span>{{ __('home.hero.scroll') }}</span>
        </div>
        <p class="sr-only">{{ __('home.hero.scene_label') }}</p>
    </section>

    {{-- Full-section title: Our Journey --}}
    <section class="section journey-title" id="journey-title" data-sky="dawn" data-spine-label="{{ __('home.glance.eyebrow') }}" aria-labelledby="journey-title-h2">
        <div class="container journey-title__inner">
            <p class="eyebrow">{{ __('home.glance.eyebrow') }}</p>
            <h1 id="journey-title-h2" class="journey-title__text" data-split>{{ __('home.glance.title') }}</h1>
        </div>
    </section>

    {{-- C. Capability roadside --}}
    @php $services = trans('services.items'); @endphp
    <section class="section roadside" id="capabilities" data-sky="noon" data-spine-label="{{ __('home.roadside.eyebrow') }}" data-roadside aria-labelledby="roadside-title">
        <div class="container">
            <header class="section-head section-head--split">
                <div>
                    <p class="eyebrow">{{ __('home.roadside.eyebrow') }}</p>
                    <h2 id="roadside-title" class="h2" data-split>{{ __('home.roadside.title') }}</h2>
                </div>
                <p class="lead">{{ __('home.roadside.lede') }}</p>
            </header>
        </div>

        <div class="roadside__frame container">
            <div class="roadside__stage" aria-hidden="true">
                @foreach ($services as $slug => $item)
                    <div class="roadside__scene" data-scene="{{ $slug }}" @if ($loop->first) data-active @endif>
                        @include('partials.scenes.'.$item['scene'])
                    </div>
                @endforeach
                <div class="roadside__caption">
                    @foreach ($services as $slug => $item)
                        <span data-caption="{{ $slug }}" @if ($loop->first) data-active @endif>{{ $item['km'] }} · {{ $item['title'] }}</span>
                    @endforeach
                </div>
            </div>

            <div class="roadside__track" aria-hidden="true">
                <span class="roadside__line"></span>
                <span class="roadside__vehicle" data-roadside-vehicle><x-logo variant="mark" title="" /></span>
            </div>

            <ol class="roadside__stops" data-roadside-stops>
                @foreach ($services as $slug => $item)
                    <li class="stop" data-stop="{{ $slug }}" data-palette="{{ $item['palette'] }}" @if ($loop->first) data-active @endif>
                        <span class="stop__km">{{ $item['km'] }}</span>
                        <h3 class="stop__title">{{ $item['title'] }}</h3>
                        <p class="stop__text">{{ $item['summary'] }}</p>
                        <a href="{{ ServiceLink::href($slug) }}" {{ ServiceLink::attributes($slug) }} class="stop__link" data-stop-link>
                            {{ __('common.actions.explore') }}<span class="sr-only"> {{ $item['title'] }}</span>
                            @if (ServiceLink::external($slug)){{ ServiceLink::marker($slug) }}@else<span aria-hidden="true">→</span>@endif
                        </a>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Partners --}}
    @include('partials.sections.partners')

    {{-- E. Operational network --}}
    @include('partials.sections.network')

    {{-- Core values --}}
    @include('partials.sections.values')

    {{-- Future horizon --}}
    @include('partials.sections.future')

    {{-- Final CTA --}}
    @include('partials.sections.cta')

</x-layout>
