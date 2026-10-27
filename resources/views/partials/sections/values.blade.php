<section class="section values" data-sky="bluehour" data-spine-label="{{ __('home.values.eyebrow') }}" aria-labelledby="values-title">
    <x-pattern class="values__pattern" scale="0.05" />
    <div class="container">
        <header class="section-head">
            <p class="eyebrow">{{ __('home.values.eyebrow') }}</p>
            <h2 id="values-title" class="h2" data-split>{{ $title ?? __('home.values.title') }}</h2>
        </header>
        <ol class="values__list">
            @foreach (trans('company.values') as $i => $value)
                <li class="value" data-reveal>
                    <svg class="value__glyph" viewBox="{{ $value['glyph'] === 'mark' ? '0 0 661.1 572.4' : '0 0 1400 1400' }}" aria-hidden="true" focusable="false">
                        <use href="#{{ $value['glyph'] === 'mark' ? 'lf-mark' : 'lf-motif-'.$value['glyph'] }}" />
                    </svg>
                    <span class="value__num" aria-hidden="true">0{{ $i + 1 }}</span>
                    <h3 class="value__name">{{ $value['name'] }}</h3>
                    <p class="value__text">— {{ $value['text'] }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
