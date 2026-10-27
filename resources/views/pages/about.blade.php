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

    {{-- Mission & vision, exact wording --}}
    <section class="section mv" data-sky="bluehour" data-spine-label="{{ __('about.mission_label') }}" aria-label="{{ __('about.mission_label') }} & {{ __('about.vision_label') }}">
        <x-pattern class="mv__pattern" scale="0.045" />
        <div class="container mv__grid">
            <figure class="mv__item" data-reveal>
                <figcaption class="mv__label"><svg viewBox="0 0 1400 1400" aria-hidden="true"><use href="#lf-motif-star" /></svg>{{ __('about.mission_label') }}</figcaption>
                <blockquote><p>{{ __('company.mission') }}</p></blockquote>
            </figure>
            <figure class="mv__item" data-reveal>
                <figcaption class="mv__label"><svg viewBox="0 0 1400 1400" aria-hidden="true"><use href="#lf-motif-diamond" /></svg>{{ __('about.vision_label') }}</figcaption>
                <blockquote><p>{{ __('company.vision') }}</p></blockquote>
            </figure>
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
        <div class="container advantage__grid">
            <div>
                <p class="eyebrow" id="advantage-title">{{ __('about.advantage.eyebrow') }}</p>
                <p class="statement" data-split>{{ __('company.competitive_advantage') }}</p>
            </div>
            <div class="advantage__strengths">
                <h3 class="h4">{{ __('about.advantage.strengths_title') }}</h3>
                <ul class="checklist">
                    @foreach (__('company.strengths') as $strength)
                        <li data-reveal>{{ $strength }}</li>
                    @endforeach
                </ul>
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
        <div class="container about-future__inner">
            <p class="eyebrow eyebrow--light" id="about-future-title">{{ __('about.future.eyebrow') }}</p>
            <p class="statement statement--light" data-split>{{ __('about.future.text') }}</p>
            <p class="status status--planned">{{ __('common.status.planned') }}</p>
        </div>
    </section>

    @include('partials.sections.cta')

</x-layout>
