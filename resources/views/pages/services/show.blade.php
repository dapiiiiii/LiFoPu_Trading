@use('App\Support\ServiceLink')
@php
    $labels = trans('services.labels');
    $nextItem = trans("services.items.$next");
    $interestHref = route('team', ['interest' => $item['inquiry']]);
@endphp
<x-layout :title="$item['title'].' | '.config('lifopu.company.name')" :description="$item['meta_description']" page="service" :palette="$item['palette']">

    <x-page-hero :eyebrow="__('common.nav.services')" :km="$item['km']" :title="$item['title']" :statement="$item['hero_title']" :lede="$item['lede']" :scene="$item['scene']" :caption="$slug === 'fuel-transportation' ? null : $item['moment']" class="page-hero--service page-hero--{{ $item['scene'] }}" data-moment="{{ $item['scene'] }}">
        <div class="page-hero__actions">
            <a href="{{ $interestHref }}" class="btn btn--primary btn--lg">{{ $labels['inquire'] }} <span aria-hidden="true">→</span></a>
        </div>
    </x-page-hero>

    {{-- At a glance: profile wording + facts. Services without facts skip it. --}}
    @isset($item['facts'])
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

        {{-- Product pictures: a photo from the service bay, then the range on a lit shelf. --}}
        @isset($item['gallery'])
            <div class="container svc-gallery">
                @php $photo = $item['gallery']['photo']; $range = $item['gallery']['range']; @endphp
                <figure class="svc-gallery__photo" data-reveal>
                    <img src="{{ asset($photo['src']) }}" width="{{ $photo['width'] }}" height="{{ $photo['height'] }}" alt="{{ $photo['alt'] }}" loading="lazy" decoding="async">
                    <figcaption>{{ $photo['caption'] }}</figcaption>
                </figure>
                <figure class="svc-gallery__range" data-reveal>
                    <div class="svc-gallery__shelf">
                        <img src="{{ asset($range['src']) }}" width="{{ $range['width'] }}" height="{{ $range['height'] }}" alt="{{ $range['alt'] }}" loading="lazy" decoding="async">
                    </div>
                    <figcaption>{{ $range['caption'] }}</figcaption>
                </figure>
            </div>
        @endisset
    </section>
    @endisset

    {{-- Chapters. Fuel retail shows them as three pumps on a forecourt at night. --}}
    <section class="section chapters @if ($slug === 'fuel-retail') chapters--forecourt @endif" data-sky="{{ $slug === 'fuel-retail' ? 'dusk' : 'noon' }}" data-spine-label="{{ $item['sections'][0]['title'] }}" aria-label="{{ $item['title'] }}">
        <div class="container">
            @if ($slug === 'fuel-retail')
                @php $pumpIcons = ['nozzle', 'tanker', 'station']; @endphp
                <div class="pumps">
                    @foreach ($item['sections'] as $i => $chapter)
                        <article class="pump" data-reveal>
                            <div class="pump__screen" aria-hidden="true">@include('partials.scenes.thumb', ['scene' => $pumpIcons[$i] ?? 'nozzle'])</div>
                            <h2 class="pump__title">{{ $chapter['title'] }}</h2>
                            <p class="pump__text">{{ $chapter['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="panel-grid panel-grid--3">
                    @foreach ($item['sections'] as $i => $chapter)
                        <article class="panel" data-reveal>
                            <h2 class="panel__title">{{ $chapter['title'] }}</h2>
                            <p class="panel__text">{{ $chapter['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            @endif

            @if ($slug === 'lubricants')
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

    @include('partials.sections.cta', ['href' => $interestHref, 'label' => $labels['inquire']])

    <nav class="next-stop" data-palette="{{ $nextItem['palette'] }}" aria-label="{{ $labels['next'] }}">
        <div class="container next-stop__inner">
            <span class="next-stop__label">{{ $labels['next'] }} · {{ $nextItem['km'] }}</span>
            <a href="{{ ServiceLink::href($next) }}" {{ ServiceLink::attributes($next) }} class="next-stop__link">
                <span class="next-stop__title">{{ $nextItem['title'] }}</span>
                <span class="next-stop__arrow" aria-hidden="true">→</span>
            </a>
        </div>
    </nav>

</x-layout>
