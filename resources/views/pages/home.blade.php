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

    {{-- Company at a glance --}}
    <section class="section glance" id="at-a-glance" data-sky="morning" data-spine-label="{{ __('home.glance.eyebrow') }}" aria-labelledby="glance-title">
        <p class="ghost-title glance__ghost" aria-hidden="true">{{ __('home.glance.ghost') }}</p>
        <div class="container glance__grid">
            <div class="glance__intro">
                <p class="eyebrow">{{ __('home.glance.eyebrow') }}</p>
                <h2 id="glance-title" class="h2" data-split>{{ __('home.glance.title') }}</h2>
                <p class="lead">{{ __('home.glance.body') }}</p>
                <p class="glance__ranking" data-reveal>
                    <x-logo variant="mark" title="" class="glance__ranking-mark" />
                    <span>{{ __('company.ranking') }}</span>
                </p>
            </div>
            <div class="glance__facts">
                <dl class="stats">
                    @foreach (trans('company.stats') as $stat)
                        <div class="stat stat--{{ $stat['key'] }}" data-reveal>
                            <dt class="stat__label">{{ $stat['label'] }}</dt>
                            <dd class="stat__value">
                                <span data-count="{{ $stat['count'] }}" data-decimals="{{ $stat['decimals'] }}" data-prefix="{{ $stat['prefix'] }}" data-suffix="{{ $stat['suffix'] }}">{{ $stat['value'] }}</span>
                            </dd>
                            <dd class="stat__detail">{{ $stat['detail'] }}</dd>
                        </div>
                    @endforeach
                </dl>
                <p class="source-note">{{ __('company.stats_source') }}</p>
            </div>
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
                        <span data-caption="{{ $slug }}" @if ($loop->first) data-active @endif>KM {{ $item['km'] }} — {{ $item['title'] }}</span>
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
                        <span class="stop__km">{{ __('home.roadside.km') }} {{ $item['km'] }}</span>
                        <h3 class="stop__title">{{ $item['title'] }}</h3>
                        <p class="stop__text">{{ $item['summary'] }}</p>
                        <a href="{{ route('services.show', $slug) }}" class="stop__link" data-stop-link>
                            {{ __('common.actions.explore') }}<span class="sr-only"> {{ $item['title'] }}</span> <span aria-hidden="true">→</span>
                        </a>
                    </li>
                @endforeach
            </ol>
            <p class="roadside__hint">{{ __('home.roadside.hint') }}</p>
        </div>
    </section>

    {{-- F. Road timeline --}}
    @include('partials.sections.timeline')

    {{-- E. Operational network --}}
    @include('partials.sections.network')

    {{-- Core values --}}
    @include('partials.sections.values')

    {{-- People & organizational capability --}}
    <section class="section people" data-sky="night" data-spine-label="{{ __('home.people.eyebrow') }}" aria-labelledby="people-title">
        <div class="container">
            <header class="section-head section-head--split">
                <div>
                    <p class="eyebrow">{{ __('home.people.eyebrow') }}</p>
                    <h2 id="people-title" class="h2" data-split>{{ __('home.people.title') }}</h2>
                </div>
                <p class="lead">{{ __('home.people.lede') }}</p>
            </header>
            @include('partials.sections.org')
        </div>
    </section>

    {{-- Future horizon --}}
    @include('partials.sections.future')

    {{-- Final CTA --}}
    @include('partials.sections.cta')

</x-layout>
