@use('App\Support\ServiceLink')
@php
    $labels = trans('services.labels');
    $nextItem = trans("services.items.$next");
    $segments = trans('markets.segments');
    $interestHref = route('contact', ['interest' => $item['inquiry']]);
@endphp
<x-layout :title="$item['title'].' | '.config('lifopu.company.name')" :description="$item['meta_description']" page="service" :palette="$item['palette']">

    <x-page-hero :eyebrow="__('common.nav.services')" :km="$item['km']" :title="$item['title']" :statement="$item['hero_title']" :lede="$item['lede']" :scene="$item['scene']" :caption="$slug === 'fuel-transportation' ? null : $item['moment']" class="page-hero--service page-hero--{{ $item['scene'] }}" data-moment="{{ $item['scene'] }}">
        <div class="page-hero__actions">
            <a href="{{ $interestHref }}" class="btn btn--primary btn--lg">{{ $labels['inquire'] }} <span aria-hidden="true">→</span></a>
        </div>
    </x-page-hero>

    {{-- What we do (profile wording) + facts --}}
    <section class="section svc-summary" data-sky="morning" data-spine-label="{{ $labels['at_a_glance'] }}" aria-labelledby="summary-title">
        <div class="container svc-summary__grid">
            <div class="panel panel--quote" data-reveal>
                <svg class="panel__watermark" viewBox="0 0 661.1 572.4" aria-hidden="true"><use href="#lf-mark" /></svg>
                <p class="eyebrow" id="summary-title">{{ $labels['at_a_glance'] }}</p>
                <p>{{ $item['summary'] }}</p>
            </div>
            <dl class="fact-stack">
                @foreach ($item['facts'] as $fact)
                    <div class="panel panel--fact" data-reveal>
                        <dt>{{ $fact['label'] }}</dt>
                        <dd>{{ $fact['value'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    {{-- Chapters --}}
    <section class="section chapters" data-sky="noon" data-spine-label="{{ $item['sections'][0]['title'] }}" aria-label="{{ $item['title'] }}">
        <div class="container">
            <div class="panel-grid panel-grid--3">
                @foreach ($item['sections'] as $i => $chapter)
                    <article class="panel" data-reveal>
                        <span class="chapter__num" aria-hidden="true">0{{ $i + 1 }}</span>
                        <h2 class="panel__title">{{ $chapter['title'] }}</h2>
                        <p class="panel__text">{{ $chapter['text'] }}</p>
                    </article>
                @endforeach
            </div>

            @if ($slug === 'fuel-retail')
                <div class="stations" aria-labelledby="stations-title">
                    <h3 id="stations-title" class="h4">{{ __('company.stats.1.label') }}</h3>
                    <ol class="stations__list">
                        @foreach (trans('company.stations') as $i => $station)
                            <li class="station-card" data-reveal>
                                <span class="station-card__num">0{{ $i + 1 }}</span>
                                <span class="station-card__name">{{ $station }}</span>
                                <svg class="station-card__icon" viewBox="0 0 661.1 572.4" aria-hidden="true"><use href="#lf-mark" /></svg>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @elseif ($slug === 'lubricants')
                <div class="chips-block">
                    <h3 class="h4">{{ $labels['channels'] }}</h3>
                    <ul class="chips">
                        @foreach ($item['channels'] as $channel)
                            <li data-reveal>{{ $channel }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>

    {{-- Material moment: the other services play theirs in the hero; transport follows the load on scroll. --}}
    @if ($slug === 'fuel-transportation')
        <section class="section moment moment--route" data-sky="bluehour" data-spine-label="{{ $item['moment']['title'] }}" data-moment="route" aria-labelledby="moment-title">
            <div class="moment__text container">
                <p class="eyebrow eyebrow--light">{{ $labels['route'] }}</p>
                <h2 id="moment-title" class="h2">{{ $item['moment']['title'] }}</h2>
                <p class="lead">{{ $item['moment']['text'] }}</p>
            </div>
            <div class="moment__stage container">
                @include('partials.scenes.route')
            </div>
        </section>
    @endif

    @isset($item['next'])
        <section class="section svc-next" data-sky="night" data-spine-label="{{ $labels['planned'] }}" aria-labelledby="svc-next-title">
            <div class="future__horizon" aria-hidden="true"><span></span></div>
            <div class="container svc-next__inner">
                <p class="status status--planned">{{ $labels['planned'] }}</p>
                <h2 id="svc-next-title" class="h2">{{ $item['next']['title'] }}</h2>
                <p class="lead">{{ $item['next']['text'] }}</p>
            </div>
        </section>
    @endisset

    @if (count($item['audiences']))
        <section class="section audiences" data-sky="morning" data-spine-label="{{ $labels['who'] }}" aria-labelledby="audiences-title">
            <div class="container">
                <h2 id="audiences-title" class="eyebrow">{{ $labels['who'] }}</h2>
                <ul class="audiences__list">
                    @foreach ($item['audiences'] as $key)
                        <li data-reveal><a href="{{ route('markets') }}#{{ $key }}">{{ $segments[$key]['title'] }} <span aria-hidden="true">→</span></a></li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @include('partials.sections.cta', ['href' => $interestHref, 'label' => $labels['inquire']])

    <nav class="next-stop" data-palette="{{ $nextItem['palette'] }}" aria-label="{{ $labels['next'] }}">
        <a href="{{ ServiceLink::href($next) }}" {{ ServiceLink::attributes($next) }} class="next-stop__link container">
            <span class="next-stop__label">{{ $labels['next'] }} · KM {{ $nextItem['km'] }}</span>
            <span class="next-stop__title">{{ $nextItem['title'] }}@if (ServiceLink::external($next)){{ ServiceLink::marker($next) }}@else <span aria-hidden="true">→</span>@endif</span>
        </a>
    </nav>

</x-layout>
