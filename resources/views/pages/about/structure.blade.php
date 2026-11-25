<x-layout :title="__('about.structure.eyebrow').' | '.config('lifopu.company.name')" :description="__('about.structure.lede')" page="about">

    <x-page-hero :eyebrow="__('about.eyebrow')" :title="__('about.structure.eyebrow')" :lede="__('about.structure.title')" scene="lanes" ghost="Org" />

    {{-- Organizational structure --}}
    <section class="section structure" data-sky="night" data-spine-label="{{ __('about.structure.eyebrow') }}" aria-labelledby="structure-title">
        <div class="container">
            <header class="section-head section-head--split">
                <div>
                    <p class="eyebrow">{{ __('about.structure.eyebrow') }}</p>
                    <h2 id="structure-title" class="h2" data-split>{{ __('about.structure.title') }}</h2>
                </div>
                <p class="lead">{{ __('about.structure.lede') }}</p>
            </header>
            @include('partials.sections.org')
        </div>
    </section>

    @include('partials.sections.cta')

    @include('partials.about-chapter-nav', [
        'prevUrl'   => route('about.section', 'advantage'),
        'prevNum'   => 'Chapter 05',
        'prevLabel' => __('about.advantage.eyebrow'),
        'nextUrl'   => route('about.section', 'future'),
        'nextNum'   => 'Chapter 07',
        'nextLabel' => __('about.future.eyebrow'),
    ])

</x-layout>
