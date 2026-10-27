@props(['motif' => 'pair', 'scale' => 0.05, 'interactive' => false])
@php
    $id = 'lfp-'.\Illuminate\Support\Str::random(6);
    // Tile sizes in mark units; spacing measured from the guideline pattern pages.
    [$w, $h, $inner] = match ($motif) {
        'band' => [2900, 1500, '<use href="#lf-motif-star" width="1400" height="1400" x="50" y="50"/><use href="#lf-motif-diamond" width="1400" height="1400" x="1500" y="50"/>'],
        'star' => [1700, 1700, '<use href="#lf-motif-star" width="1400" height="1400" x="150" y="150"/>'],
        default => [1488.8, 807.1, '<use href="#lf-motif-pair" width="1488.8" height="661.1" x="0" y="73"/>'],
    };
@endphp
<svg aria-hidden="true" focusable="false" {{ $attributes->merge(['class' => 'lf-pattern']) }} @if ($interactive) data-pattern-shift @endif>
    <defs>
        <pattern id="{{ $id }}" width="{{ $w }}" height="{{ $h }}" patternUnits="userSpaceOnUse" patternTransform="scale({{ $scale }})" data-scale="{{ $scale }}">
            {!! $inner !!}
        </pattern>
    </defs>
    <rect width="100%" height="100%" fill="url(#{{ $id }})" />
</svg>
