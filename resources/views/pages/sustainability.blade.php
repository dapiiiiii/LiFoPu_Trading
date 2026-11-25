<x-layout :title="__('sustainability.meta_title')" :description="__('sustainability.meta_description')" page="sustainability">

    <x-page-hero :eyebrow="__('sustainability.eyebrow')" :title="__('sustainability.title')" :lede="__('sustainability.lede')" scene="horizon" tone="light" />

    {{-- Commitments first: operations, then community, in the company's own wording. --}}
    <section class="section commitments" data-sky="dusk" data-spine-label="{{ __('sustainability.commitments.0.eyebrow') }}" aria-label="{{ __('sustainability.commitments.0.eyebrow') }}">
        <div class="container">
            @foreach (__('sustainability.commitments') as $commitment)
                <div class="commitment" data-reveal>
                    <div>
                        <p class="eyebrow eyebrow--light">{{ $commitment['eyebrow'] }}</p>
                        @if ($commitment['title'])
                            <h2 class="h3">{{ $commitment['title'] }}</h2>
                        @endif
                    </div>
                    <p class="lead">{{ $commitment['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- The four values behind them, side by side. --}}
    <section class="section pillars" data-sky="morning" data-spine-label="{{ __('sustainability.eyebrow') }}" aria-label="{{ __('sustainability.eyebrow') }}">
        <div class="container">
            @php $glyphs = ['safety' => 'diamond', 'environment' => 'pairs', 'continuity' => 'star', 'local' => 'mark']; @endphp
            <ol class="pillars__grid">
                @foreach (__('sustainability.pillars') as $pillar)
                    @php $glyph = $glyphs[$pillar['id']] ?? 'star'; @endphp
                    <li class="panel pillar" id="{{ $pillar['id'] }}" data-reveal>
                        <span class="pillar__glyph">
                            <svg class="panel__glyph" viewBox="{{ $glyph === 'mark' ? '0 0 661.1 572.4' : '0 0 1400 1400' }}" aria-hidden="true"><use href="#{{ $glyph === 'mark' ? 'lf-mark' : 'lf-motif-'.$glyph }}" /></svg>
                        </span>
                        <h2 class="panel__title">{{ $pillar['value'] }}</h2>
                        <p class="pillar__text">{{ \Illuminate\Support\Str::ucfirst($pillar['text']) }}</p>
                        <p class="panel__text">{{ $pillar['detail'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    @include('partials.sections.cta')

</x-layout>
