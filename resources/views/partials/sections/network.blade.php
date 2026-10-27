@php
    $n = trans('home.network.nodes');
    // Schematic only: supply on the left, LiFoPu in the middle, markets on the right. No routes, depots or live data are implied.
    $lanes = [
        'fuel' => ['y' => 140, 'path' => 'M150 140H1060', 'branch' => 'M600 140C680 140 700 250 780 250H1060'],
        'lube' => ['y' => 380, 'path' => 'M150 380H1000'],
        'coffee' => ['y' => 540, 'path' => 'M400 540H1080'],
    ];
    $nodes = [
        ['x' => 150, 'y' => 140, 'label' => [$n['depots']], 'type' => 'ext', 'lane' => 'fuel'],
        ['x' => 600, 'y' => 140, 'label' => [$n['transport']], 'type' => 'own', 'lane' => 'fuel'],
        ['x' => 820, 'y' => 140, 'label' => [$n['stations']], 'type' => 'own', 'lane' => 'fuel'],
        ['x' => 1060, 'y' => 140, 'label' => [$n['motorists']], 'type' => 'ext', 'lane' => 'fuel'],
        ['x' => 1060, 'y' => 250, 'label' => [$n['commercial']], 'type' => 'ext', 'lane' => 'fuel'],
        ['x' => 150, 'y' => 380, 'label' => [$n['caltex']], 'type' => 'ext', 'lane' => 'lube'],
        ['x' => 1000, 'y' => 380, 'label' => ['Retailers, garages,', 'workshops & industry'], 'type' => 'ext', 'lane' => 'lube'],
        ['x' => 700, 'y' => 540, 'label' => [$n['lela']], 'type' => 'own', 'lane' => 'coffee'],
        ['x' => 1080, 'y' => 540, 'label' => [$n['export']], 'type' => 'ext', 'lane' => 'coffee'],
    ];
@endphp
<section class="section network" data-sky="dusk" data-spine-label="{{ __('home.network.eyebrow') }}" data-network aria-labelledby="network-title">
    <div class="container">
        <header class="section-head section-head--split">
            <div>
                <p class="eyebrow">{{ __('home.network.eyebrow') }}</p>
                <h2 id="network-title" class="h2" data-split>{{ __('home.network.title') }}</h2>
            </div>
            <p class="lead">{{ __('home.network.lede') }}</p>
        </header>

        <figure class="network__figure">
            <svg class="network__svg" viewBox="0 0 1200 640" role="img" aria-labelledby="network-title network-desc" focusable="false">
                <desc id="network-desc">{{ implode(' ', trans('home.network.text')) }}</desc>
                <g class="net__axis" aria-hidden="true">
                    <text x="150" y="40" class="net__zone">SUPPLY</text>
                    <text x="400" y="40" class="net__zone" text-anchor="middle">LIFOPU</text>
                    <text x="1060" y="40" class="net__zone" text-anchor="end">MARKETS</text>
                </g>
                {{-- The group spine --}}
                <line x1="400" y1="80" x2="400" y2="600" class="net__spine" />
                @foreach ($lanes as $key => $lane)
                    <g class="net__lane" data-lane="{{ $key }}">
                        <path d="{{ $lane['path'] }}" class="net__road" />
                        <path d="{{ $lane['path'] }}" class="net__flow" />
                        @isset($lane['branch'])
                            <path d="{{ $lane['branch'] }}" class="net__road" />
                            <path d="{{ $lane['branch'] }}" class="net__flow" />
                        @endisset
                        <circle cx="400" cy="{{ $lane['y'] }}" r="7" class="net__junction" />
                    </g>
                @endforeach
                <path d="M1080 540h60" class="net__flow net__flow--out" />
                <path d="M1130 532l12 8-12 8" class="net__arrow" />

                @foreach ($nodes as $node)
                    <g class="net__node net__node--{{ $node['type'] }}" data-lane="{{ $node['lane'] }}" tabindex="0">
                        <circle cx="{{ $node['x'] }}" cy="{{ $node['y'] }}" r="11" />
                        <text x="{{ $node['x'] }}" y="{{ $node['y'] + 36 }}" text-anchor="middle" class="net__label">
                            @foreach ($node['label'] as $i => $line)
                                <tspan x="{{ $node['x'] }}" dy="{{ $i ? 18 : 0 }}">{{ $line }}</tspan>
                            @endforeach
                        </text>
                    </g>
                @endforeach

                <g class="net__core" transform="translate(400 330)">
                    <circle r="54" />
                    <use href="#lf-mark" x="-30" y="-28" width="60" height="52" />
                    <text y="86" text-anchor="middle" class="net__label net__label--core">LiFoPu</text>
                </g>
                <g class="net__legend" transform="translate(150 610)" aria-hidden="true">
                    <circle r="7" class="net__legend-own" /><text x="16" y="5">LiFoPu group</text>
                    <circle cx="190" r="7" class="net__legend-ext" /><text x="206" y="5">Supply partner or market</text>
                </g>
            </svg>
            <figcaption>
                <details class="network__text">
                    <summary>{{ __('common.actions.read_diagram') }}</summary>
                    <ol>
                        @foreach (trans('home.network.text') as $line)
                            <li>{{ $line }}</li>
                        @endforeach
                    </ol>
                </details>
            </figcaption>
        </figure>
    </div>
</section>
