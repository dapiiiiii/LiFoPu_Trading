@use('App\Support\ServiceLink')
@php
    $contact = config('lifopu.contact');
    $services = trans('services.items');
@endphp
<footer class="footer" data-sky="night">
    <div class="footer__road" aria-hidden="true"><span></span></div>
    <div class="footer__inner container">
        <div class="footer__brand">
            <a href="{{ route('home') }}" class="footer__logo" aria-label="{{ config('lifopu.company.name') }}: {{ __('common.nav.home') }}">
                <x-logo variant="stacked" title="" />
            </a>
            <p class="footer__tagline">{{ config('lifopu.company.tagline') }}</p>
            <p class="footer__desc">{{ __('common.footer.description') }}</p>
        </div>

        <nav class="footer__col" aria-labelledby="footer-explore">
            <h2 id="footer-explore" class="footer__heading">{{ __('common.footer.explore') }}</h2>
            <ul>
                <li><a href="{{ route('about') }}">{{ __('common.nav.about') }}</a></li>
                <li><a href="{{ route('services') }}">{{ __('common.nav.services') }}</a></li>
                <li><a href="{{ route('markets') }}">{{ __('common.nav.markets') }}</a></li>
                <li><a href="{{ route('sustainability') }}">{{ __('common.nav.sustainability') }}</a></li>
                <li><a href="{{ route('contact') }}">{{ __('common.nav.contact') }}</a></li>
            </ul>
        </nav>

        <nav class="footer__col" aria-labelledby="footer-services">
            <h2 id="footer-services" class="footer__heading">{{ __('common.footer.services') }}</h2>
            <ul>
                @foreach ($services as $slug => $service)
                    <li><a href="{{ ServiceLink::href($slug) }}" {{ ServiceLink::attributes($slug) }}>{{ $service['title'] }}{{ ServiceLink::marker($slug) }}</a></li>
                @endforeach
            </ul>
        </nav>

        <div class="footer__col">
            <h2 class="footer__heading">{{ __('common.footer.contact') }}</h2>
            <address class="footer__contact">
                <span>{{ $contact['person'] }}</span>
                <a href="tel:{{ $contact['phone_href'] }}">{{ $contact['phone'] }}</a>
                <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
            </address>
            @if (count(config('lifopu.social')))
                <ul class="footer__social">
                    @foreach (config('lifopu.social') as $network => $url)
                        <li><a href="{{ $url }}" rel="me noopener" target="_blank">{{ ucfirst($network) }}</a></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="footer__band" data-pattern-zone>
        <x-pattern motif="band" scale="0.03" interactive />
        <x-logo variant="horizontal" title="" class="footer__band-logo" />
    </div>

    <div class="footer__legal container">
        <p>© {{ now()->year }} {{ config('lifopu.company.name') }}. {{ __('common.footer.rights') }}</p>
        <ul>
            <li><a href="{{ route('privacy') }}">{{ __('common.footer.privacy') }}</a></li>
            <li><a href="{{ route('sitemap') }}">{{ __('common.footer.sitemap') }}</a></li>
            <li><a href="#main" class="footer__top">{{ __('common.footer.top') }} <span aria-hidden="true">↑</span></a></li>
        </ul>
    </div>
</footer>
