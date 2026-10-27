{{-- Four lanes converging on one horizon: four businesses, one road. --}}
<svg class="scene scene--lanes" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
    <defs>
        <linearGradient id="ln-sky" x1="0" y1="0" x2="0" y2="520" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#0c0b0a" />
            <stop offset=".8" stop-color="#2a1a10" />
            <stop offset="1" stop-color="#a24a1c" />
        </linearGradient>
        <linearGradient id="ln-ground" x1="0" y1="520" x2="0" y2="900" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#1d1611" />
            <stop offset="1" stop-color="#080706" />
        </linearGradient>
    </defs>
    <rect width="1600" height="520" fill="url(#ln-sky)" />
    <rect y="520" width="1600" height="380" fill="url(#ln-ground)" />
    <polygon points="800,520 -200,900 1800,900" fill="#141210" />
    @foreach ([['#d84500', -600], ['#c69822', -200], ['#ff5c00', 200], ['#c69822', 600]] as $i => [$color, $x])
        <line x1="800" y1="520" x2="{{ 800 + $x * 1.6 }}" y2="900" stroke="#3a322b" stroke-width="2" stroke-dasharray="18 22" />
        <line class="scene__lane" x1="800" y1="520" x2="{{ 800 + $x * 1.6 }}" y2="900" stroke="{{ $color }}" stroke-width="2.5" pathLength="1" style="--i: {{ $i }}" />
    @endforeach
    <circle cx="800" cy="520" r="5" fill="#fff1d6" />
</svg>
