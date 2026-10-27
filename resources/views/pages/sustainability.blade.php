<x-layout :title="__('sustainability.meta_title')" :description="__('sustainability.meta_description')" page="sustainability">

    <x-page-hero :eyebrow="__('sustainability.eyebrow')" :title="__('sustainability.title')" :lede="__('sustainability.lede')" scene="horizon" tone="light" />

    <section class="section pillars" data-sky="morning" data-spine-label="{{ __('sustainability.eyebrow') }}" aria-label="{{ __('sustainability.eyebrow') }}">
        <div class="container">
            <ol class="pillar-list">
                @foreach (__('sustainability.pillars') as $pillar)
                    <li class="pillar" id="{{ $pillar['id'] }}" data-reveal>
                        <span class="pillar__num" aria-hidden="true">0{{ $loop->iteration }}</span>
                        <h2 class="pillar__value">{{ $pillar['value'] }}</h2>
                        <p class="pillar__text">— {{ $pillar['text'] }}</p>
                        <p class="pillar__detail">{{ $pillar['detail'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section transition" data-sky="dusk" data-spine-label="{{ __('sustainability.transition.eyebrow') }}" aria-labelledby="transition-title">
        <div class="container transition__grid">
            <div>
                <p class="eyebrow eyebrow--light">{{ __('sustainability.transition.eyebrow') }}</p>
                <h2 id="transition-title" class="h2" data-split>{{ __('sustainability.transition.title') }}</h2>
            </div>
            <div>
                <p class="lead">{{ __('sustainability.transition.text') }}</p>
                <p class="status status--planned">{{ __('sustainability.transition.status') }}</p>
            </div>
        </div>
        <div class="transition__lines" aria-hidden="true">
            <span class="transition__line transition__line--solid">{{ __('common.status.operating') }}</span>
            <span class="transition__line transition__line--dashed">{{ __('common.status.planned') }}</span>
        </div>
    </section>

    @include('partials.sections.cta')

</x-layout>
