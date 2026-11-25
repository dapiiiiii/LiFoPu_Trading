<x-layout :title="__('about.mission_label').' & '.__('about.vision_label').' | '.config('lifopu.company.name')" :description="__('company.mission')" page="about">

    <x-page-hero :eyebrow="__('about.eyebrow')" :title="__('about.mission_label').' & '.__('about.vision_label')" :lede="__('about.title')" scene="horizon" ghost="Purpose" />

    {{-- Mission & vision, exact wording, with the key phrase emphasised --}}
    @php
        $emphasise = fn (string $text, string $phrase) => str_replace(e($phrase), '<strong>'.e($phrase).'</strong>', e($text));
        $statements = [
            ['label' => __('about.mission_label'), 'motif' => 'star', 'html' => $emphasise(__('company.mission'), __('about.mission_highlight'))],
            ['label' => __('about.vision_label'), 'motif' => 'diamond', 'html' => $emphasise(__('company.vision'), __('about.vision_highlight'))],
        ];
    @endphp
    <section class="section mv" data-sky="bluehour" data-spine-label="{{ __('about.mission_label') }}" aria-label="{{ __('about.mission_label') }} & {{ __('about.vision_label') }}">
        <x-pattern class="mv__pattern" scale="0.045" />
        <div class="container">
          <div class="panel-grid panel-grid--2">
            @foreach ($statements as $statement)
                <figure class="panel panel--mv" data-reveal>
                    <figcaption class="mv__label">
                        <svg class="panel__glyph" viewBox="0 0 1400 1400" aria-hidden="true"><use href="#lf-motif-{{ $statement['motif'] }}" /></svg>
                        {{ $statement['label'] }}
                    </figcaption>
                    <blockquote><p>{!! $statement['html'] !!}</p></blockquote>
                </figure>
            @endforeach
          </div>
        </div>
    </section>

    @include('partials.sections.cta')

    @include('partials.about-chapter-nav', [
        'prevUrl'   => route('about'),
        'prevNum'   => 'Chapter 01',
        'prevLabel' => __('about.overview.eyebrow'),
        'nextUrl'   => route('about.section', 'mark'),
        'nextNum'   => 'Chapter 03',
        'nextLabel' => __('about.mark.eyebrow'),
    ])

</x-layout>
