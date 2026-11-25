<x-layout :title="__('about.meta_title')" :description="__('about.meta_description')" page="about">

    <x-page-hero :eyebrow="__('about.eyebrow')" :title="__('about.title')" :lede="__('about.lede')" scene="topo" ghost="LiFoPu" />

    {{-- Overview + the name --}}
    <section class="section overview" data-sky="morning" data-spine-label="{{ __('about.overview.eyebrow') }}" aria-labelledby="overview-title">
        <div class="container overview__grid">
            <div>
                <p class="eyebrow" id="overview-title">{{ __('about.overview.eyebrow') }}</p>
                <div class="prose prose--lead">
                    @foreach (__('about.overview.paragraphs') as $p)
                        <p data-reveal>{{ $p }}</p>
                    @endforeach
                </div>
            </div>
            <aside class="name-card" aria-labelledby="name-title" data-reveal>
                <p class="eyebrow">{{ __('about.name.eyebrow') }}</p>
                <p class="name-card__word" id="name-title" aria-label="LiFoPu: Live For Purpose">
                    @foreach (__('about.name.parts') as [$head, $tail])
                        <span class="name-card__part"><b>{{ $head }}</b><i>{{ $tail }}</i></span>
                    @endforeach
                </p>
                <p class="name-card__text">{{ __('company.acronym') }}</p>
                <p class="name-card__brand">{{ __('company.acronym_brand') }}</p>
            </aside>
        </div>
    </section>

    @include('partials.sections.cta')

    @include('partials.about-chapter-nav', [
        'prevUrl'   => null,
        'nextUrl'   => route('about.section', 'mission'),
        'nextNum'   => 'Chapter 02',
        'nextLabel' => __('about.mission_label').' & '.__('about.vision_label'),
    ])

</x-layout>
