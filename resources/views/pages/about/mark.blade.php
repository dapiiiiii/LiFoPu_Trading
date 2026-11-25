<x-layout :title="__('about.mark.eyebrow').' | '.config('lifopu.company.name')" :description="__('about.mark.title')" page="about">

    <x-page-hero :eyebrow="__('about.eyebrow')" :title="__('about.mark.eyebrow')" :lede="__('about.mark.title')" scene="topo" ghost="Arrow" />

    {{-- The mark, explained with the mark itself --}}
    <section class="section mark-story" data-sky="night" data-spine-label="{{ __('about.mark.eyebrow') }}" data-mark-story aria-labelledby="mark-title">
        <div class="container mark-story__grid">
            <div class="mark-story__visual" aria-hidden="true">
                <x-logo variant="mark" title="" :parts="true" class="mark-story__mark" />
                <span class="mark-story__north">N</span>
            </div>
            <div>
                <p class="eyebrow eyebrow--light">{{ __('about.mark.eyebrow') }}</p>
                <h2 id="mark-title" class="h2" data-split>{{ __('about.mark.title') }}</h2>
                <ol class="mark-story__list">
                    @foreach (__('company.mark_story') as $i => $idea)
                        <li tabindex="0" data-mark-step="{{ $i }}">
                            <h3>{{ $idea['title'] }}</h3>
                            <p>{{ $idea['text'] }}</p>
                        </li>
                    @endforeach
                </ol>
                <p class="mark-story__hint">{{ __('about.mark.hint') }}</p>
                <p class="mark-story__personality">{{ __('company.personality') }}</p>
            </div>
        </div>
    </section>

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
