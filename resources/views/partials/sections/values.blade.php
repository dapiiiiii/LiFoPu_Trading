@php
    // The values sit on a ring road, one every 72 degrees, starting at the top.
    $values = trans('company.values');
    $count = count($values);
    $points = collect(range(0, $count - 1))->map(fn ($i) => [
        round(320 + 228 * cos(deg2rad(-90 + 360 / $count * $i)), 2),
        round(320 + 228 * sin(deg2rad(-90 + 360 / $count * $i)), 2),
    ]);
@endphp
<section class="section values" data-sky="bluehour" data-spine-label="{{ __('home.values.eyebrow') }}" data-values aria-labelledby="values-title">
    <x-pattern class="values__pattern" scale="0.05" />
    <div class="container">
        <header class="section-head">
            <p class="eyebrow">{{ __('home.values.eyebrow') }}</p>
            <h2 id="values-title" class="h2" data-split>{{ $title ?? __('home.values.title') }}</h2>
        </header>

        <div class="values__layout">
            <div>
                <ol class="values__list">
                    @foreach ($values as $i => $value)
                        <li class="value" tabindex="0" data-value="{{ $i }}" data-reveal @if ($loop->first) data-active @endif>
                            <span class="value__num" aria-hidden="true">0{{ $i + 1 }}</span>
                            <h3 class="value__name">{{ $value['name'] }}</h3>
                            <p class="value__text">{{ \Illuminate\Support\Str::ucfirst($value['text']) }}</p>
                        </li>
                    @endforeach
                </ol>
                <p class="values__hint">{{ __('home.values.hint') }}</p>
            </div>

            {{-- The star of the mark, drawn between the five values; the chosen one turns to the top. --}}
            <div class="values__stage" aria-hidden="true">
                <svg class="values__dial" viewBox="0 0 640 640" focusable="false">
                    <circle class="values__ticks" cx="320" cy="320" r="300" pathLength="360" />
                    <circle class="values__edge" cx="320" cy="320" r="246" />
                    <circle class="values__edge" cx="320" cy="320" r="210" />
                    <g class="values__ring">
                        <circle class="values__road" cx="320" cy="320" r="228" />
                        <circle class="values__lane" cx="320" cy="320" r="228" />
                        @foreach ($points as $i => [$x, $y])
                            @php [$x2, $y2] = $points[($i + 2) % $count]; @endphp
                            <line class="values__chord" x1="{{ $x }}" y1="{{ $y }}" x2="{{ $x2 }}" y2="{{ $y2 }}" pathLength="1" data-value-chord="{{ $i }} {{ ($i + 2) % $count }}" style="--i: {{ $i }}" />
                        @endforeach
                        @foreach ($points as $i => [$x, $y])
                            @php $mark = $values[$i]['glyph'] === 'mark'; @endphp
                            <g class="vnode" transform="translate({{ $x }} {{ $y }})" data-value-node="{{ $i }}" style="--i: {{ $i }}" @if ($i === 0) data-active @endif>
                                <g class="vnode__spin">
                                    <circle class="vnode__halo" r="38" />
                                    <circle class="vnode__disc" r="38" />
                                    <svg class="vnode__glyph" x="-21" y="-21" width="42" height="42" viewBox="{{ $mark ? '0 0 661.1 572.4' : '0 0 1400 1400' }}">
                                        <use href="#{{ $mark ? 'lf-mark' : 'lf-motif-'.$values[$i]['glyph'] }}" />
                                    </svg>
                                </g>
                            </g>
                        @endforeach
                    </g>
                    <circle class="values__hub" cx="320" cy="320" r="118" />
                    <line class="values__needle" x1="320" y1="202" x2="320" y2="142" pathLength="1" />
                    <path class="values__pointer" d="M306 6 H334 L320 30 Z" />
                </svg>
                <p class="values__count"><span data-values-num>01</span><span class="values__total">/ 0{{ $count }}</span></p>
            </div>
        </div>
    </div>
</section>
