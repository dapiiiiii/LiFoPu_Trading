@use('App\Support\ServiceLink')
@php
    $links = [
        ['route' => 'about',          'label' => __('common.nav.about'),          'sub' => 'about'],
        ['route' => 'services',       'label' => __('common.nav.services'),        'sub' => 'services'],
        ['route' => 'sustainability', 'label' => __('common.nav.sustainability')],
        ['route' => 'contact',        'label' => __('common.nav.contact')],
    ];
    $services = trans('services.items');
    $aboutSections = [
        ['url' => route('about'),                       'num' => '01', 'label' => __('about.overview.eyebrow'), 'is_active' => request()->routeIs('about') && !request()->routeIs('about.section')],
        ['url' => route('about.section', 'mission'),   'num' => '02', 'label' => __('about.mission_label').' & '.__('about.vision_label'), 'is_active' => request()->is('about/mission')],
        ['url' => route('about.section', 'mark'),      'num' => '03', 'label' => __('about.mark.eyebrow'), 'is_active' => request()->is('about/mark')],
        ['url' => route('about.section', 'history'),   'num' => '04', 'label' => __('about.history.eyebrow'), 'is_active' => request()->is('about/history')],
        ['url' => route('about.section', 'advantage'), 'num' => '05', 'label' => __('about.advantage.eyebrow'), 'is_active' => request()->is('about/advantage')],
        ['url' => route('about.section', 'structure'), 'num' => '06', 'label' => __('about.structure.eyebrow'), 'is_active' => request()->is('about/structure')],
        ['url' => route('about.section', 'future'),    'num' => '07', 'label' => __('about.future.eyebrow'), 'is_active' => request()->is('about/future')],
    ];
    $isActive = fn (string $route) => request()->routeIs($route) || ($route === 'about' && request()->routeIs('about.*')) || ($route === 'services' && request()->routeIs('services.*'));
@endphp
<header class="nav" data-nav>
    <div class="nav__bar">
        <a href="{{ route('home') }}" class="nav__brand" aria-label="{{ config('lifopu.company.name') }}: {{ __('common.nav.home') }}">
            <x-logo variant="horizontal" title="" class="nav__logo" data-nav-logo />
        </a>

        <nav class="nav__primary" aria-label="{{ __('common.nav.label') }}">
            <ul class="nav__list">
                @foreach ($links as $link)
                    <li class="nav__item {{ isset($link['sub']) ? 'nav__item--sub' : '' }}" @if(isset($link['sub'])) data-dropdown @endif>
                        <a href="{{ route($link['route']) }}" class="nav__link" @if ($isActive($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a>

                        @if(isset($link['sub']) && $link['sub'] === 'about')
                            {{-- About Us dropdown: each section as its own row --}}
                            <button type="button" class="nav__subtoggle" aria-expanded="false" aria-controls="nav-about" data-dropdown-toggle>
                                <span class="sr-only">{{ __('common.nav.about_submenu') }}</span>
                                <svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 4.5 6 8l3.5-3.5" fill="none" stroke="currentColor" stroke-width="1.5" /></svg>
                            </button>
                            <div class="nav__dropdown nav__dropdown--wide" id="nav-about" data-dropdown-panel hidden>
                                <ul class="nav__services">
                                    @foreach ($aboutSections as $section)
                                        <li>
                                            <a href="{{ $section['url'] }}" class="nav__service" @if ($section['is_active']) aria-current="page" @endif>
                                                <span class="nav__km">{{ $section['num'] }}</span>
                                                <span class="nav__service-title">{{ $section['label'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('about') }}" class="nav__all">{{ __('common.nav.about') }} <span aria-hidden="true">→</span></a>
                            </div>

                        @elseif(isset($link['sub']) && $link['sub'] === 'services')
                            {{-- Products & Services dropdown --}}
                            <button type="button" class="nav__subtoggle" aria-expanded="false" aria-controls="nav-services" data-dropdown-toggle>
                                <span class="sr-only">{{ __('common.nav.submenu') }}</span>
                                <svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2.5 4.5 6 8l3.5-3.5" fill="none" stroke="currentColor" stroke-width="1.5" /></svg>
                            </button>
                            <div class="nav__dropdown" id="nav-services" data-dropdown-panel hidden>
                                <ul class="nav__services">
                                    @foreach ($services as $slug => $service)
                                        <li>
                                            <a href="{{ ServiceLink::href($slug) }}" {{ ServiceLink::attributes($slug) }} class="nav__service" data-palette="{{ $service['palette'] }}" @if (request()->is("services/$slug")) aria-current="page" @endif>
                                                <span class="nav__km">{{ $service['km'] }}</span>
                                                <span class="nav__service-title">{{ $service['title'] }}{{ ServiceLink::marker($slug) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('services') }}" class="nav__all">{{ __('common.nav.services_all') }} <span aria-hidden="true">→</span></a>
                            </div>

                        @endif
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="nav__tools">
            <button type="button" class="nav__tool nav__tool--palette" data-palette-open aria-keyshortcuts="Control+K Meta+K" aria-label="{{ __('common.palette.open') }}">
                <svg viewBox="0 0 20 20" aria-hidden="true"><circle cx="8.5" cy="8.5" r="5.5" fill="none" stroke="currentColor" stroke-width="1.5" /><path d="m13 13 4 4" stroke="currentColor" stroke-width="1.5" /></svg>
                <kbd class="nav__kbd" data-shortcut-label>{{ __('common.palette.shortcut') }}</kbd>
            </button>
            <button type="button" class="nav__tool nav__theme" data-theme-toggle aria-label="{{ __('common.theme.to_dark') }}" data-label-light="{{ __('common.theme.to_light') }}" data-label-dark="{{ __('common.theme.to_dark') }}">
                {{-- Sun shows in the dark theme (go light), moon in the light theme (go dark). --}}
                <svg class="nav__theme-sun" viewBox="0 0 20 20" aria-hidden="true"><circle cx="10" cy="10" r="3.6" fill="none" stroke="currentColor" stroke-width="1.5" /><path d="M10 1.5v2.2M10 16.3v2.2M1.5 10h2.2M16.3 10h2.2M4 4l1.55 1.55M14.45 14.45 16 16M4 16l1.55-1.55M14.45 5.55 16 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /></svg>
                <svg class="nav__theme-moon" viewBox="0 0 20 20" aria-hidden="true"><path d="M16.5 12.6A7 7 0 0 1 7.4 3.5a7 7 0 1 0 9.1 9.1Z" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" /></svg>
            </button>
            {{-- Experience settings button (disabled for now)
            <button type="button" class="nav__tool" data-settings-open aria-expanded="false" aria-controls="settings" aria-label="{{ __('common.settings.open') }}">
                <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3 6h8M15 6h2M3 14h2M9 14h8" stroke="currentColor" stroke-width="1.5" /><circle cx="13" cy="6" r="2" fill="none" stroke="currentColor" stroke-width="1.5" /><circle cx="7" cy="14" r="2" fill="none" stroke="currentColor" stroke-width="1.5" /></svg>
            </button>
            --}}
            <a href="{{ route('team') }}" class="btn btn--primary btn--sm nav__cta" @if (request()->routeIs('team')) aria-current="page" @endif>{{ __('common.nav.cta') }}</a>
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
            {{-- About sections in mobile overlay --}}
            <ul class="nav__overlay-services">
                @foreach ($aboutSections as $section)
                    <li><a href="{{ $section['url'] }}"><span class="nav__km">{{ $section['num'] }}</span> {{ $section['label'] }}</a></li>
                @endforeach
            </ul>
            <ul class="nav__overlay-services">
                @foreach ($services as $slug => $service)
                    <li><a href="{{ ServiceLink::href($slug) }}" {{ ServiceLink::attributes($slug) }}><span class="nav__km">{{ $service['km'] }}</span> {{ $service['title'] }}{{ ServiceLink::marker($slug) }}</a></li>
                @endforeach
            </ul>
            <div class="nav__overlay-foot">
                <a href="tel:{{ config('lifopu.contact.phone_href') }}">{{ config('lifopu.contact.phone') }}</a>
                <a href="mailto:{{ config('lifopu.contact.email') }}">{{ config('lifopu.contact.email') }}</a>
            </div>
            <div class="theme-switch" role="radiogroup" aria-label="{{ __('common.theme.label') }}">
                <button type="button" role="radio" aria-checked="true" data-theme-set="light">{{ __('common.theme.light') }}</button>
                <button type="button" role="radio" aria-checked="false" data-theme-set="dark">{{ __('common.theme.dark') }}</button>
            </div>
        </nav>
    </div>
</header>
