<x-layout :title="__('sustainability.meta_title')" :description="__('sustainability.meta_description')" page="sustainability">

    <x-page-hero :eyebrow="__('sustainability.eyebrow')" :title="__('sustainability.title')" :lede="__('sustainability.lede')" scene="horizon" tone="light" />

    <section class="section pillars" data-sky="morning" data-spine-label="{{ __('sustainability.eyebrow') }}" aria-label="{{ __('sustainability.eyebrow') }}">
        <div class="container">
            @php $glyphs = ['safety' => 'diamond', 'environment' => 'pairs', 'continuity' => 'star', 'local' => 'mark']; @endphp
            <ol class="panel-grid panel-grid--2">
                @foreach (__('sustainability.pillars') as $pillar)
                    @php $glyph = $glyphs[$pillar['id']] ?? 'star'; @endphp
                    <li class="panel pillar" id="{{ $pillar['id'] }}" data-reveal>
                        <div class="panel__top">
                            <svg class="panel__glyph" viewBox="{{ $glyph === 'mark' ? '0 0 661.1 572.4' : '0 0 1400 1400' }}" aria-hidden="true"><use href="#{{ $glyph === 'mark' ? 'lf-mark' : 'lf-motif-'.$glyph }}" /></svg>
                            <span class="panel__num" aria-hidden="true">0{{ $loop->iteration }}</span>
                        </div>
                        <h2 class="panel__title">{{ $pillar['value'] }}</h2>
                        <p class="pillar__text">{{ \Illuminate\Support\Str::ucfirst($pillar['text']) }}</p>
                        <p class="panel__text">{{ $pillar['detail'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section transition" data-sky="dusk" data-spine-label="{{ __('sustainability.transition.eyebrow') }}" aria-labelledby="transition-title">
        <div class="container transition__grid">
            <div>
                <p class="eyebrow eyebrow--light">{{ __('sustainability.transition.eyebrow') }}</p>
                <h2 id="transition-title" class="h2" data-split>{{ __('sustainability.transition.title') }}</h2>
            </div>
            <div>
                <p class="lead">{{ __('sustainability.transition.text') }}</p>
                <p class="status status--planned">{{ __('sustainability.transition.status') }}</p>
            </div>
        </div>
        <div class="transition__lines" aria-hidden="true">
            <span class="transition__line transition__line--solid">{{ __('common.status.operating') }}</span>
            <span class="transition__line transition__line--dashed">{{ __('common.status.planned') }}</span>
        </div>
    </section>

    @include('partials.sections.cta')

</x-layout>
