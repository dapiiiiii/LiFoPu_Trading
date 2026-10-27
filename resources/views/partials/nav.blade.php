@php
    $links = [
        ['route' => 'about', 'label' => __('common.nav.about')],
        ['route' => 'services', 'label' => __('common.nav.services'), 'sub' => true],
        ['route' => 'markets', 'label' => __('common.nav.markets')],
        ['route' => 'sustainability', 'label' => __('common.nav.sustainability')],
        ['route' => 'contact', 'label' => __('common.nav.contact')],
    ];
    $services = trans('services.items');
    $isActive = fn (string $route) => request()->routeIs($route) || ($route === 'services' && request()->routeIs('services.*'));
@endphp
<header class="nav" data-nav>
    <div class="nav__bar">
        <a href="{{ route('home') }}" class="nav__brand" aria-label="{{ config('lifopu.company.name') }} — {{ __('common.nav.home') }}">
            <x-logo variant="horizontal" title="" class="nav__logo" data-nav-logo />
        </a>

        <nav class="nav__primary" aria-label="{{ __('common.nav.label') }}">
            <ul class="nav__list">
                @foreach ($links as $link)
                    <li class="nav__item {{ isset($link['sub']) ? 'nav__item--sub' : '' }}" @isset($link['sub']) data-dropdown @endisset>
                        <a href="{{ route($link['route']) }}" class="nav__link" @if ($isActive($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a>
                        @isset($link['sub'])
                            <button type="button" class="nav__subtoggle" aria-expanded="false" aria-controls="nav-services" data-dropdown-toggle>
                                <span class="sr-only">{{ __('common.nav.submenu') }}</span>
                                <svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 4.5 6 8l3.5-3.5" fill="none" stroke="currentColor" stroke-width="1.5" /></svg>
                            </button>
                            <div class="nav__dropdown" id="nav-services" data-dropdown-panel hidden>
                                <ul class="nav__services">
                                    @foreach ($services as $slug => $service)
                                        <li>
                                            <a href="{{ route('services.show', $slug) }}" class="nav__service" data-palette="{{ $service['palette'] }}" @if (request()->is("services/$slug")) aria-current="page" @endif>
                                                <span class="nav__km">KM {{ $service['km'] }}</span>
                                                <span class="nav__service-title">{{ $service['title'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('services') }}" class="nav__all">{{ __('common.nav.services_all') }} <span aria-hidden="true">→</span></a>
                            </div>
                        @endisset
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="nav__tools">
            <button type="button" class="nav__tool nav__tool--palette" data-palette-open aria-keyshortcuts="Control+K Meta+K" aria-label="{{ __('common.palette.open') }}">
                <svg viewBox="0 0 20 20" aria-hidden="true"><circle cx="8.5" cy="8.5" r="5.5" fill="none" stroke="currentColor" stroke-width="1.5" /><path d="m13 13 4 4" stroke="currentColor" stroke-width="1.5" /></svg>
                <kbd class="nav__kbd" data-shortcut-label>{{ __('common.palette.shortcut') }}</kbd>
            </button>
            <button type="button" class="nav__tool" data-settings-open aria-expanded="false" aria-controls="settings" aria-label="{{ __('common.settings.open') }}">
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3 6h8M15 6h2M3 14h2M9 14h8" stroke="currentColor" stroke-width="1.5" /><circle cx="13" cy="6" r="2" fill="none" stroke="currentColor" stroke-width="1.5" /><circle cx="7" cy="14" r="2" fill="none" stroke="currentColor" stroke-width="1.5" /></svg>
            </button>
            <a href="{{ route('contact') }}" class="btn btn--primary btn--sm nav__cta">{{ __('common.nav.cta') }}</a>
            <button type="button" class="nav__burger" aria-expanded="false" aria-controls="nav-overlay" data-menu-toggle>
                <span class="sr-only" data-menu-label data-open="{{ __('common.nav.menu_open') }}" data-close="{{ __('common.nav.menu_close') }}">{{ __('common.nav.menu_open') }}</span>
                <span class="nav__burger-lines" aria-hidden="true"><span></span><span></span></span>
            </button>
        </div>
    </div>

    <div class="nav__overlay" id="nav-overlay" data-menu hidden>
        <x-pattern class="nav__overlay-pattern" scale="0.04" />
        <nav class="nav__overlay-inner" aria-label="{{ __('common.nav.label') }}">
            <ol class="nav__big">
                <li><a href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif><span>00</span>{{ __('common.nav.home') }}</a></li>
                @foreach ($links as $i => $link)
                    <li><a href="{{ route($link['route']) }}" @if ($isActive($link['route'])) aria-current="page" @endif><span>0{{ $i + 1 }}</span>{{ $link['label'] }}</a></li>
                @endforeach
            </ol>
            <ul class="nav__overlay-services">
                @foreach ($services as $slug => $service)
                    <li><a href="{{ route('services.show', $slug) }}"><span class="nav__km">KM {{ $service['km'] }}</span> {{ $service['title'] }}</a></li>
                @endforeach
            </ul>
            <div class="nav__overlay-foot">
                <a href="tel:{{ config('lifopu.contact.phone_href') }}">{{ config('lifopu.contact.phone') }}</a>
                <a href="mailto:{{ config('lifopu.contact.email') }}">{{ config('lifopu.contact.email') }}</a>
            </div>
        </nav>
    </div>
</header>
