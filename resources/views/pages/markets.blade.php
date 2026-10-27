@php
    $segments = trans('markets.segments');
    $services = trans('services.items');
@endphp
<x-layout :title="__('markets.meta_title')" :description="__('markets.meta_description')" page="markets">

    <x-page-hero :eyebrow="__('markets.eyebrow')" :title="__('markets.title')" :lede="__('markets.lede')" scene="crossroads" ghost="Markets" />

    <section class="section segments" data-sky="morning" data-spine-label="{{ __('markets.eyebrow') }}" aria-label="{{ __('markets.eyebrow') }}">
        <div class="container">
            <ol class="segment-list">
                @foreach ($segments as $key => $segment)
                    <li class="segment" id="{{ $key }}" data-reveal>
                        <span class="segment__num" aria-hidden="true">0{{ $loop->iteration }}</span>
                        <h2 class="segment__title">{{ $segment['title'] }}</h2>
                        <p class="segment__text">{{ $segment['text'] }}</p>
                        <ul class="segment__services">
                            @foreach ($segment['services'] as $slug)
                                <li><a href="{{ route('services.show', $slug) }}" data-palette="{{ $services[$slug]['palette'] }}">{{ $services[$slug]['title'] }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section matrix" data-sky="noon" data-spine-label="{{ __('markets.matrix_title') }}" aria-labelledby="matrix-title">
        <div class="container">
            <h2 id="matrix-title" class="h2" data-split>{{ __('markets.matrix_title') }}</h2>
            <div class="matrix__scroll" tabindex="0" role="region" aria-labelledby="matrix-title">
                <table class="matrix__table">
                    <caption class="sr-only">{{ __('markets.matrix_caption') }}</caption>
                    <thead>
                        <tr>
                            <td></td>
                            @foreach (['fuel-retail', 'lubricants', 'fuel-transportation'] as $slug)
                                <th scope="col"><span class="matrix__km">KM {{ $services[$slug]['km'] }}</span>{{ __("common.services_short.$slug") }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($segments as $segment)
                            <tr>
                                <th scope="row">{{ $segment['title'] }}</th>
                                @foreach (['fuel-retail', 'lubricants', 'fuel-transportation'] as $slug)
                                    <td>
                                        @if (in_array($slug, $segment['services'], true))
                                            <svg class="matrix__yes" viewBox="0 0 661.1 572.4" role="img" aria-label="Yes"><use href="#lf-mark" /></svg>
                                        @else
                                            <span class="matrix__no" aria-label="No">—</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('partials.sections.cta')

</x-layout>
