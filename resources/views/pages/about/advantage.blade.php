<x-layout :title="__('about.advantage.eyebrow').' | '.config('lifopu.company.name')" :description="__('about.advantage.title')" page="about">

    <x-page-hero :eyebrow="__('about.eyebrow')" :title="__('about.advantage.eyebrow')" :lede="__('about.advantage.title')" scene="crossroads" ghost="Edge" />

    {{-- Competitive advantage --}}
    <section class="section advantage" data-sky="morning" data-spine-label="{{ __('about.advantage.eyebrow') }}" aria-labelledby="advantage-title">
        <div class="container">
            <header class="section-head">
                <p class="eyebrow">{{ __('about.advantage.eyebrow') }}</p>
                <h2 id="advantage-title" class="h2" data-split>{{ __('about.advantage.title') }}</h2>
            </header>
            <div class="advantage__grid">
                <div class="panel panel--quote" data-reveal>
                    <svg class="panel__watermark" viewBox="0 0 661.1 572.4" aria-hidden="true"><use href="#lf-mark" /></svg>
                    <p>{{ __('company.competitive_advantage') }}</p>
                </div>
                <div class="advantage__strengths">
                    <h3 class="h4">{{ __('about.advantage.strengths_title') }}</h3>
                    <ul class="panel-grid panel-grid--2">
                        @foreach (__('company.strengths') as $i => $strength)
                            <li class="panel panel--tile" data-reveal>
                                <div class="panel__top">
                                    <svg class="panel__glyph" viewBox="0 0 1400 1400" aria-hidden="true"><use href="#lf-motif-{{ ['star', 'diamond', 'pinwheel', 'pairs'][$i % 4] }}" /></svg>
                                    <span class="panel__num">0{{ $i + 1 }}</span>
                                </div>
                                <p class="panel__title">{{ $strength }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @include('partials.sections.cta')

    @include('partials.about-chapter-nav', [
        'prevUrl'   => route('about.section', 'history'),
        'prevNum'   => 'Chapter 04',
        'prevLabel' => __('about.history.eyebrow'),
        'nextUrl'   => route('about.section', 'structure'),
        'nextNum'   => 'Chapter 06',
        'nextLabel' => __('about.structure.eyebrow'),
    ])

</x-layout>
