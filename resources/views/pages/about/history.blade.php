<x-layout :title="__('about.history.eyebrow').' | '.config('lifopu.company.name')" :description="__('about.meta_description')" page="about">

    <x-page-hero :eyebrow="__('about.eyebrow')" :title="__('about.history.eyebrow')" scene="route" ghost="Journey" />

    @include('partials.sections.timeline', ['eyebrow' => __('about.eyebrow'), 'title' => __('about.history.eyebrow')])

    @include('partials.sections.cta')

    @include('partials.about-chapter-nav', [
        'prevUrl'   => route('about.section', 'mark'),
        'prevNum'   => 'Chapter 03',
        'prevLabel' => __('about.mark.eyebrow'),
        'nextUrl'   => route('about.section', 'advantage'),
        'nextNum'   => 'Chapter 05',
        'nextLabel' => __('about.advantage.eyebrow'),
    ])

</x-layout>
