<x-layout :title="__('about.operations.eyebrow').' | '.config('lifopu.company.name')" :description="__('about.operations.title')" page="about">

    <x-page-hero :eyebrow="__('about.eyebrow')" :title="__('about.operations.eyebrow')" :lede="__('about.operations.title')" scene="lanes" ghost="Network" />

    {{-- Supply, LiFoPu and markets: the operational network (moved here from the home page) --}}
    @include('partials.sections.network')

    @include('partials.sections.cta')

    @include('partials.about-chapter-nav', [
        'prevUrl'   => route('about.section', 'mission'),
        'prevNum'   => 'Chapter 02',
        'prevLabel' => __('about.mission_label').' & '.__('about.vision_label'),
        'nextUrl'   => route('about.section', 'history'),
        'nextNum'   => 'Chapter 04',
        'nextLabel' => __('about.history.eyebrow'),
    ])

</x-layout>
