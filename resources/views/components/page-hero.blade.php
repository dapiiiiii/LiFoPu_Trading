@props([
    'eyebrow',
    'title',
    'statement' => null,
    'lede' => null,
    'scene' => 'road-end',
    'sceneData' => [],
    'tone' => 'dark',
    'ghost' => null,
    'km' => null,
    'caption' => null,
])
<section {{ $attributes->merge(['class' => "page-hero page-hero--{$tone}"]) }} data-sky="{{ $tone === 'light' ? 'morning' : 'dawn' }}" data-spine-label="{{ $eyebrow }}" data-page-hero aria-labelledby="page-title">
    <div class="page-hero__scene" aria-hidden="true" data-page-hero-scene>
        @include('partials.scenes.'.$scene, $sceneData)
    </div>
    <div class="page-hero__shade" aria-hidden="true"></div>
    <div class="page-hero__content container">
        <p class="eyebrow">
            @if ($km)<span class="eyebrow__km">KM {{ $km }}</span>@endif
            {{ $eyebrow }}
        </p>
        <h1 id="page-title" class="page-hero__title" data-split>{{ $title }}</h1>
        @if ($statement)
            <p class="page-hero__statement">{{ $statement }}</p>
        @endif
        @if ($lede)
            <p class="page-hero__lede">{{ $lede }}</p>
        @endif
        {{ $slot }}
    </div>
    @if ($caption)
        <p class="page-hero__caption"><b>{{ $caption['title'] }}</b> {{ $caption['text'] }}</p>
    @endif
    @if ($ghost)
        <p class="ghost-title page-hero__ghost" aria-hidden="true">{{ $ghost }}</p>
    @endif
</section>
