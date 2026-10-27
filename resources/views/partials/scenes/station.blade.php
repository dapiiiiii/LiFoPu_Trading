{{-- Service station canopy at dusk. Lamps switch on in sequence when the scene enters view (data-canopy). Illustration, not a specific site. --}}
<svg class="scene scene--station" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false" data-canopy>
    <defs>
        <linearGradient id="st-sky" x1="0" y1="0" x2="0" y2="600" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#0c0f1c" />
            <stop offset=".55" stop-color="#2b211d" />
            <stop offset=".85" stop-color="#8d4524" />
            <stop offset="1" stop-color="#c8622c" />
        </linearGradient>
        <linearGradient id="st-ground" x1="0" y1="600" x2="0" y2="900" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#2a1d17" />
            <stop offset="1" stop-color="#0b0807" />
        </linearGradient>
        <linearGradient id="st-cone" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0" stop-color="#fff2d9" stop-opacity=".55" />
            <stop offset="1" stop-color="#fff2d9" stop-opacity="0" />
        </linearGradient>
        <radialGradient id="st-pool" cx="800" cy="720" r="620" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#ffe7c2" stop-opacity=".5" />
            <stop offset=".5" stop-color="#f3a35e" stop-opacity=".16" />
            <stop offset="1" stop-color="#f3a35e" stop-opacity="0" />
        </radialGradient>
        <linearGradient id="st-under" x1="0" y1="330" x2="0" y2="372" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#3a3532" />
            <stop offset="1" stop-color="#1c1917" />
        </linearGradient>
    </defs>

    <rect width="1600" height="600" fill="url(#st-sky)" />
    <path fill="#3d2216" d="M0 600V560l90-10 40-16h120l40 14 160 6 70-12h140l40 14 200 10 110-16 40-14h130l40 12 140 8 140 6v44Z" />
    <rect y="600" width="1600" height="300" fill="url(#st-ground)" />

    <g class="scene__lit">
        <rect y="600" width="1600" height="300" fill="url(#st-pool)" class="scene__pool" />
        @foreach ([[470, 372], [800, 372], [1130, 372]] as [$x, $y])
            <polygon class="scene__cone" points="{{ $x - 70 }},{{ $y }} {{ $x + 70 }},{{ $y }} {{ $x + 230 }},770 {{ $x - 230 }},770" fill="url(#st-cone)" />
        @endforeach
    </g>

    {{-- Canopy --}}
    <polygon points="230,330 1370,330 1290,372 310,372" fill="url(#st-under)" />
    <g class="scene__lamps">
        @foreach ([400, 540, 730, 870, 1060, 1200] as $x)
            <rect class="scene__lamp" x="{{ $x - 34 }}" y="352" width="68" height="7" rx="3" fill="#fff4dd" />
        @endforeach
    </g>
    <rect x="230" y="262" width="1140" height="70" fill="#d84500" class="scene__fascia" />
    <rect x="230" y="262" width="1140" height="6" fill="#ff7a3d" opacity=".6" />
    <rect x="230" y="326" width="1140" height="6" fill="#8f2e00" />
    <x-logo variant="horizontal" title="" x="680" y="276" width="240" height="44" style="color:#fff" class="scene__fascia-logo" />

    {{-- Columns, islands, pumps --}}
    @foreach ([470, 800, 1130] as $x)
        <rect x="{{ $x - 13 }}" y="372" width="26" height="320" fill="#c9c2bb" />
        <rect x="{{ $x - 13 }}" y="372" width="9" height="320" fill="#ffffff" opacity=".25" />
        <rect x="{{ $x - 120 }}" y="676" width="240" height="22" rx="4" fill="#4a4440" />
        <rect x="{{ $x - 120 }}" y="676" width="240" height="5" fill="#d84500" />
        @foreach ([-78, 52] as $dx)
            <g transform="translate({{ $x + $dx }} 560)">
                <rect width="44" height="118" rx="5" fill="#e9e3dc" />
                <rect y="0" width="44" height="16" rx="4" fill="#d84500" />
                <rect class="scene__screen" x="8" y="26" width="28" height="18" rx="2" fill="#2fd1a7" opacity=".9" />
                <rect x="8" y="54" width="28" height="4" fill="#bdb5ad" />
                <rect x="36" y="64" width="12" height="30" rx="3" fill="#2b2522" />
            </g>
        @endforeach
    @endforeach

    {{-- Brand pylon --}}
    <g transform="translate(1440 300)">
        <rect width="70" height="400" fill="#211d1b" />
        <rect width="70" height="110" fill="#d84500" class="scene__fascia" />
        <use href="#lf-mark" x="12" y="24" width="46" height="40" fill="#ffffff" />
        <rect x="10" y="130" width="50" height="34" rx="2" fill="#141110" />
        <rect x="10" y="176" width="50" height="34" rx="2" fill="#141110" />
        <rect class="scene__screen" x="16" y="138" width="38" height="18" fill="#ffb347" opacity=".85" />
        <rect class="scene__screen" x="16" y="184" width="38" height="18" fill="#ffb347" opacity=".85" />
    </g>

    {{-- A vehicle pulling in --}}
    <g transform="translate(150 640)" class="scene__car">
        <path d="M0 50c10-26 40-36 80-38l40-26h110l46 28c40 4 60 14 64 36v18H0Z" fill="#14100e" />
        <circle cx="70" cy="70" r="22" fill="#080606" /><circle cx="270" cy="70" r="22" fill="#080606" />
        <rect x="320" y="44" width="16" height="8" rx="2" fill="#ffe2b0" class="scene__headlight" />
    </g>
</svg>
