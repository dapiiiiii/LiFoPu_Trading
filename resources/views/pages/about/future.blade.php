<x-layout :title="__('about.future.eyebrow').' | '.config('lifopu.company.name')" :description="__('about.future.title')" page="about">

    <x-page-hero :eyebrow="__('about.eyebrow')" :title="__('about.future.eyebrow')" :lede="__('about.future.title')" scene="horizon" ghost="Future" />

    {{-- Future plans --}}
    <section class="section about-future" data-sky="night" data-spine-label="{{ __('about.future.eyebrow') }}" aria-labelledby="about-future-title">
        <div class="future__horizon" aria-hidden="true"><span></span></div>
        <div class="container">
            <header class="section-head">
                <p class="eyebrow eyebrow--light">{{ __('about.future.eyebrow') }}</p>
                <h2 id="about-future-title" class="h2" data-split>{{ __('about.future.title') }}</h2>
            </header>
            <ol class="panel-grid panel-grid--3">
                @foreach (__('about.future.plans') as $i => $plan)
                    <li class="panel panel--plan" data-reveal>
                        <div class="panel__top">
                            <span class="panel__icon">@include('partials.scenes.thumb', ['scene' => $plan['icon']])</span>
                            <span class="panel__num">0{{ $i + 1 }}</span>
                        </div>
                        <h3 class="panel__title">{{ $plan['title'] }}</h3>
                        <p class="panel__text">{{ $plan['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- What runs today vs. what is planned (moved here from the home page) --}}
    @include('partials.sections.future')

    @include('partials.sections.cta')

    @include('partials.about-chapter-nav', [
        'prevUrl'   => route('about.section', 'structure'),
        'prevNum'   => 'Chapter 06',
        'prevLabel' => __('about.structure.eyebrow'),
        'nextUrl'   => route('about'),
        'nextNum'   => 'Chapter 01',
        'nextLabel' => __('about.overview.eyebrow'),
    ])

</x-layout>
