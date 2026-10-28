@php
    $groups = [
        'pages' => [
            ['label' => __('common.nav.home'), 'href' => route('home'), 'keywords' => 'start hero'],
            ['label' => __('common.nav.about'), 'href' => route('about'), 'keywords' => 'company history mission vision values founder structure'],
            ['label' => __('common.nav.services'), 'href' => route('services'), 'keywords' => 'products'],
            ['label' => __('common.nav.markets'), 'href' => route('markets'), 'keywords' => 'customers motorists fleets industry government'],
            ['label' => __('common.nav.sustainability'), 'href' => route('sustainability'), 'keywords' => 'safety compliance environment ev'],
            ['label' => __('common.nav.contact'), 'href' => route('contact'), 'keywords' => 'inquiry phone email talk team'],
            ['label' => __('common.footer.privacy'), 'href' => route('privacy'), 'keywords' => 'data cookies'],
        ],
        'services' => collect(trans('services.items'))->map(fn ($item, $slug) => [
            'label' => $item['title'],
            'href' => \App\Support\ServiceLink::href($slug),
            'external' => (bool) \App\Support\ServiceLink::external($slug),
            'keywords' => $slug.' km '.$item['km'].(\App\Support\ServiceLink::external($slug) ? ' lela trading' : ''),
        ])->values()->all(),
        'actions' => [
            ['label' => __('common.palette.toggle_effects'), 'action' => 'effects', 'keywords' => 'motion animation quality accessibility'],
            ['label' => __('common.palette.toggle_sound'), 'action' => 'sound', 'keywords' => 'audio ambient mute'],
        ],
    ];
@endphp
<dialog class="palette" data-command-palette aria-labelledby="palette-title">
    <div class="palette__panel">
        <h2 id="palette-title" class="sr-only">{{ __('common.palette.open') }}</h2>
        <div class="palette__search">
            <svg viewBox="0 0 20 20" aria-hidden="true"><circle cx="8.5" cy="8.5" r="5.5" fill="none" stroke="currentColor" stroke-width="1.5" /><path d="m13 13 4 4" stroke="currentColor" stroke-width="1.5" /></svg>
            <input type="text" class="palette__input" data-palette-input role="combobox" aria-expanded="true" aria-controls="palette-list" aria-autocomplete="list" autocomplete="off" spellcheck="false" placeholder="{{ __('common.palette.placeholder') }}" aria-label="{{ __('common.palette.placeholder') }}">
            <kbd>Esc</kbd>
        </div>
        <div class="palette__list" id="palette-list" role="listbox" aria-label="{{ __('common.palette.open') }}" data-palette-list>
            @foreach ($groups as $group => $items)
                <div class="palette__group" role="group" aria-labelledby="palette-g-{{ $group }}">
                    <p class="palette__group-label" id="palette-g-{{ $group }}">{{ __("common.palette.groups.$group") }}</p>
                    @foreach ($items as $i => $item)
                        <div class="palette__option" role="option" id="palette-{{ $group }}-{{ $i }}" aria-selected="false" data-palette-option
                             @isset($item['href']) data-href="{{ $item['href'] }}" @endisset
                             @if ($item['external'] ?? false) data-external @endif
                             @isset($item['action']) data-action="{{ $item['action'] }}" @endisset
                             data-keywords="{{ strtolower($item['label'].' '.$item['keywords']) }}">
                            <span>{{ $item['label'] }}</span>
                            <span class="palette__go" aria-hidden="true">{{ ($item['external'] ?? false) ? '↗' : '↵' }}</span>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <p class="palette__empty" data-palette-empty hidden>{{ __('common.palette.empty') }}</p>
        </div>
        <p class="palette__hint">{{ __('common.palette.hint') }}</p>
    </div>
</dialog>
