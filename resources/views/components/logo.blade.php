@props(['variant' => 'horizontal', 'title' => 'LiFoPu', 'parts' => false])
@php
    use App\Support\Brand;

    $label = $title ? ['role' => 'img', 'aria-label' => $title] : ['aria-hidden' => 'true', 'focusable' => 'false'];
    $viewBox = match ($variant) {
        'mark' => '0 0 661.1 572.4',
        'stacked' => '0 0 665.1 815.4',
        default => '0 0 2518.8 572.4',
    };
@endphp
<svg viewBox="{{ $viewBox }}" fill="currentColor" {{ $attributes->merge(['class' => "lf-logo lf-logo--{$variant}"])->merge($label) }}>
    <g class="lf-logo__mark" @if ($variant === 'stacked') transform="translate(2 0)" @endif>
        @foreach (Brand::MARK as $piece => $d)
            <path d="{{ $d }}" @if ($parts) data-mark="{{ $piece }}" @endif />
        @endforeach
    </g>
    @if ($variant === 'stacked')
        <path class="lf-logo__word" transform="translate(0 651.6)" fill-rule="evenodd" d="{{ Brand::WORD }}" />
    @elseif ($variant === 'horizontal')
        <path class="lf-logo__word" transform="translate(775.6 97.3) scale(2.621)" fill-rule="evenodd" d="{{ Brand::WORD }}" />
    @endif
</svg>
