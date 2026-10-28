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

    @include('partials.sections.timeline', ['eyebrow' => __('about.history.eyebrow'), 'title' => __('about.history.title')])

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

    @include('partials.sections.values', ['title' => __('about.values.title')])

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

    {{-- Founder --}}
    @php $founder = trans('company.founder'); @endphp
    <section class="section founder" data-sky="morning" data-spine-label="{{ __('about.founder.eyebrow') }}" aria-labelledby="founder-title">
        <div class="container founder__grid">
            <div class="founder__name">
                <p class="eyebrow">{{ __('about.founder.eyebrow') }}</p>
                <h2 id="founder-title" class="h2">{{ $founder['name'] }}</h2>
                <p class="founder__role">{{ $founder['role'] }}</p>
            </div>
            <div class="prose">
                @foreach ($founder['paragraphs'] as $p)
                    <p data-reveal>{{ $p }}</p>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Future plans --}}
    <section class="section about-future" data-sky="night" data-spine-label="{{ __('about.future.eyebrow') }}" aria-labelledby="about-future-title">
        <div class="future__horizon" aria-hidden="true"><span></span></div>
        <div class="container">
            <header class="section-head section-head--split">
                <div>
                    <p class="eyebrow eyebrow--light">{{ __('about.future.eyebrow') }}</p>
                    <h2 id="about-future-title" class="h2" data-split>{{ __('about.future.title') }}</h2>
                </div>
                <p class="lead">{{ __('about.future.lede') }}</p>
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
                        <p class="status status--planned panel__foot">{{ __('common.status.planned') }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    @include('partials.sections.cta')

</x-layout>
