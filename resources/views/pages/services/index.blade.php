<x-layout :title="__('services.meta_title')" :description="__('services.meta_description')" page="services">

    <x-page-hero :eyebrow="__('services.index.eyebrow')" :title="__('services.index.title')" :lede="__('services.index.lede')" scene="lanes" ghost="Four lanes" />

    <section class="section services-list" data-sky="morning" data-spine-label="{{ __('services.index.eyebrow') }}" aria-label="{{ __('services.index.eyebrow') }}">
        <div class="container">
            <ol class="service-rows">
                @foreach (trans('services.items') as $slug => $item)
                    <li class="service-row" data-palette="{{ $item['palette'] }}" data-reveal>
                        <a href="{{ route('services.show', $slug) }}" class="service-row__link">
                            <span class="service-row__km">KM {{ $item['km'] }}</span>
                            <span class="service-row__body">
                                <span class="service-row__title">{{ $item['title'] }}</span>
                                <span class="service-row__summary">{{ $item['summary'] }}</span>
                            </span>
                            <span class="service-row__visual" aria-hidden="true">
                                @include('partials.scenes.thumb', ['scene' => $item['scene']])
                            </span>
                            <span class="service-row__go" aria-hidden="true">→</span>
                        </a>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section products" data-sky="noon" data-spine-label="{{ __('services.index.products_title') }}" aria-labelledby="products-title">
        <div class="container products__grid">
            <h2 id="products-title" class="h2" data-split>{{ __('services.index.products_title') }}</h2>
            <p class="lead">{{ __('services.index.products_text') }}</p>
        </div>
    </section>

    @include('partials.sections.network')

    @include('partials.sections.cta')

</x-layout>
