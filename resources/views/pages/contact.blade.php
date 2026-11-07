@php $contact = config('lifopu.contact'); @endphp
<x-layout :title="__('contact.meta_title')" :description="__('contact.meta_description')" page="contact">

    <x-page-hero :eyebrow="__('contact.eyebrow')" :title="__('contact.title')" :lede="__('contact.lede')" scene="road-end" class="page-hero--compact" />

    <section class="section contact" data-sky="morning" data-spine-label="{{ __('contact.intro.eyebrow') }}" aria-labelledby="contact-intro-title">
        <div class="container contact__grid">
            {{-- The inquiry form lives on its own page, Talk to Our Team. --}}
            <div class="contact__intro">
                <p class="eyebrow">{{ __('contact.intro.eyebrow') }}</p>
                <h2 id="contact-intro-title" class="h2" data-split>{{ __('contact.intro.title') }}</h2>
                <p class="lead">{{ __('contact.intro.lede') }}</p>
                <a href="{{ route('team') }}" class="btn btn--primary btn--lg">{{ __('common.nav.cta') }} <span aria-hidden="true">→</span></a>
            </div>

            <aside class="contact-card" aria-labelledby="direct-title">
                <x-pattern class="contact-card__pattern" scale="0.035" />
                <h2 id="direct-title" class="contact-card__title">{{ __('contact.direct.title') }}</h2>
                <dl class="contact-card__list">
                    <div><dt>{{ __('contact.direct.person') }}</dt><dd>{{ $contact['person'] }}</dd></div>
                    <div><dt>{{ __('contact.direct.phone') }}</dt><dd><a href="tel:{{ $contact['phone_href'] }}">{{ $contact['phone'] }}</a></dd></div>
                    <div><dt>{{ __('contact.direct.email') }}</dt><dd><a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a></dd></div>
                    @foreach (config('lifopu.more_contacts') as $person)
                        <div class="contact-card__next"><dt>{{ __('contact.direct.person') }}</dt><dd>{{ $person['person'] }}</dd></div>
                        <div><dt>{{ __('contact.direct.phone') }}</dt><dd><a href="tel:{{ $person['phone_href'] }}">{{ $person['phone'] }}</a></dd></div>
                    @endforeach
                </dl>
                <x-logo variant="stacked" title="" class="contact-card__logo" />
            </aside>
        </div>
    </section>

    {{-- Our offices --}}
    <section class="section offices" data-sky="night" data-spine-label="{{ __('contact.offices.eyebrow') }}" aria-labelledby="offices-title">
        <div class="container">
            <header class="section-head">
                <p class="eyebrow">{{ __('contact.offices.eyebrow') }}</p>
                <h2 id="offices-title" class="h2" data-split>{{ __('contact.offices.title') }}</h2>
            </header>
            <ul class="offices__list">
                @foreach (config('lifopu.offices') as $key => $office)
                    <li class="panel office office--{{ $key }}" data-reveal>
                        <div class="panel__top">
                            <span class="office__tag">{{ __('common.offices.'.$key) }}</span>
                            <span class="panel__num" aria-hidden="true">0{{ $loop->iteration }}</span>
                        </div>
                        <h3 class="panel__title">{{ $office['name'] }}</h3>
                        <p class="panel__text">{{ $office['street'] ? $office['street'].', ' : '' }}{{ $office['city'] }}, {{ config('lifopu.company.country') }}</p>
                        <p class="office__coords">{{ number_format($office['lat'], 4) }}° N · {{ number_format($office['lng'], 4) }}° E</p>
                        <a class="office__link" href="{{ $office['map'] }}" target="_blank" rel="noopener">
                            {{ __('common.offices.map') }}<span class="ext-mark" aria-hidden="true">↗</span><span class="sr-only"> ({{ __('common.opens_new_tab', ['site' => 'Google Maps']) }})</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

</x-layout>
