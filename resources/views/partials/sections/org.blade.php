@php
    $org = trans('company.org');
    $ui = trans('common.org');
    $units = $org['units'];
    $motifs = ['star', 'diamond', 'pinwheel', 'pairs'];
    // A road from the roundabout exit (top centre) down to the centre of each function column.
    $road = fn (int $i) => sprintf('M600 0 C600 80 %1$s 50 %1$s 140', ($i + .5) * 1200 / count($units));
@endphp
<div class="org" data-org>
    {{-- The General Manager is the roundabout every road leaves from. --}}
    <div class="org__crown" data-org-draw>
        <div class="org__legend">
            <p class="org__legend-title">{{ $ui['legend'] }}</p>
            <ol class="org__levels">
                @foreach ($ui['levels'] as $i => $level)
                    <li><span class="org__glyph org__glyph--{{ $i + 1 }}" aria-hidden="true"></span><span class="org__level-num">0{{ $i + 1 }}</span>{{ $level }}</li>
                @endforeach
            </ol>
        </div>
        <div class="org__hub">
            <p class="org__head"><span class="org__level">{{ $ui['level'] }} 01</span>{{ $org['head'] }}</p>
            <span class="org__ra" aria-hidden="true">
                <svg class="org__roundabout" viewBox="0 0 200 200">
                    <circle class="org__ra-bezel" cx="100" cy="100" r="97" pathLength="240" />
                    <rect class="org__ra-exit" x="90.3" y="150" width="19.4" height="50" />
                    <circle class="org__ra-road" cx="100" cy="100" r="80" />
                    <circle class="org__ra-lane" cx="100" cy="100" r="80" />
                    <circle class="org__ra-island" cx="100" cy="100" r="62" />
                    <use class="org__ra-mark" href="#lf-mark" x="70" y="74" width="60" height="52" />
                </svg>
            </span>
        </div>
        <div class="org__summary">
            <p class="org__count"><span class="org__count-num">{{ sprintf('%02d', count($units)) }}</span>{{ $ui['functions'] }}</p>
            <p class="org__hint">{{ $ui['hint'] }}</p>
        </div>
    </div>

    <div class="org__roads" data-org-draw aria-hidden="true">
        <span class="org__trunk"></span>
        <svg class="org__fan" viewBox="0 0 1200 140" preserveAspectRatio="none">
            @foreach ($units as $i => $unit)
                <path class="org__asphalt" d="{{ $road($i) }}" />
            @endforeach
            @foreach ($units as $i => $unit)
                <path class="org__halo" d="{{ $road($i) }}" data-org-route="{{ $i }}" />
                <path class="org__flow" d="{{ $road($i) }}" data-org-route="{{ $i }}" />
            @endforeach
        </svg>
    </div>

    <ol class="org__units">
        @foreach ($units as $i => $unit)
            <li class="org__unit" style="--i: {{ $i }}" data-org-draw>
                <div @class(['panel panel--org org__card', 'org__card--solo' => ! count($unit['posts'])]) tabindex="0" data-org-unit="{{ $i }}">
                    <span class="org__junction" aria-hidden="true"></span>
                    <div class="panel__top">
                        <span class="panel__num">{{ sprintf('%02d', $i + 1) }}</span>
                        <svg class="panel__glyph" viewBox="0 0 1400 1400" aria-hidden="true"><use href="#lf-motif-{{ $motifs[$i % 4] }}" /></svg>
                    </div>
                    <div class="org__title">
                        <h3 class="org__unit-name">{{ $unit['name'] }}</h3>
                        <p class="org__lead">{{ $unit['lead'] }}</p>
                    </div>
                    @if (count($unit['posts']))
                        <ul class="org__posts">
                            @foreach ($unit['posts'] as $j => $post)
                                <li class="org__post" style="--j: {{ $j }}">
                                    <span class="org__post-title">{{ $post['title'] }}</span>
                                    @if (count($post['roles']))
                                        <ul class="org__roles">
                                            @foreach ($post['roles'] as $role)
                                                <li>{{ $role }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="org__solo" aria-hidden="true"><svg class="panel__watermark" viewBox="0 0 661.1 572.4"><use href="#lf-mark" /></svg></span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</div>
