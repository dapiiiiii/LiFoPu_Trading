{{-- LiFoPu Transport tanker on the highway at blue hour, in the Transport palette (Deep Route Navy, Pulse Orange). --}}
<svg class="scene scene--tanker" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
    <defs>
        <linearGradient id="tk-sky" x1="0" y1="0" x2="0" y2="640" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#00001f" />
            <stop offset=".6" stop-color="#000058" />
            <stop offset=".9" stop-color="#1a1a7a" />
            <stop offset="1" stop-color="#ff5c00" stop-opacity=".85" />
        </linearGradient>
        <linearGradient id="tk-tank" x1="0" y1="470" x2="0" y2="625" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#4a4ad0" />
            <stop offset=".18" stop-color="#1414a8" />
            <stop offset=".6" stop-color="#000080" />
            <stop offset="1" stop-color="#00004a" />
        </linearGradient>
        <linearGradient id="tk-cab" x1="0" y1="480" x2="0" y2="660" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#2a2ab8" />
            <stop offset="1" stop-color="#00005a" />
        </linearGradient>
        <linearGradient id="tk-road" x1="0" y1="640" x2="0" y2="900" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#14143a" />
            <stop offset="1" stop-color="#05050f" />
        </linearGradient>
    </defs>

    <rect width="1600" height="640" fill="url(#tk-sky)" />
    <g class="scene__far">
        <path fill="#0a0a4a" d="M0 640V590l70-6 40-22h130l30 18 120 8 50-26h150l40 20 160 6 90-14 40-24h140l30 20 140 8 60-16h120l40 14 80 6v78Z" />
        <path fill="#050530" d="M0 640V610l120 4 80-12 200 8 140-6 220 10 180-8 160 6 140-10 160 8 200-4v34Z" />
    </g>
    <rect y="640" width="1600" height="260" fill="url(#tk-road)" />
    <rect y="640" width="1600" height="3" fill="#ff5c00" opacity=".7" />
    <g class="scene__dashes" fill="#c9c9ff" opacity=".55">
        @for ($x = -200; $x < 1800; $x += 200)
            <rect x="{{ $x }}" y="760" width="110" height="6" />
        @endfor
    </g>
    <rect class="scene__route" y="712" width="1600" height="2" fill="#ff5c00" />

    <g class="scene__truck" transform="translate(0 0)">
        <ellipse cx="850" cy="702" rx="360" ry="10" fill="#000" opacity=".5" />
        <rect x="540" y="636" width="612" height="26" fill="#05051a" />
        <rect x="560" y="470" width="452" height="156" rx="74" fill="url(#tk-tank)" />
        <rect x="575" y="482" width="420" height="10" rx="5" fill="#ffffff" opacity=".18" />
        <rect x="572" y="566" width="428" height="12" fill="#ff5c00" />
        <x-logo variant="horizontal" title="" x="640" y="503" width="250" height="56" style="color:#fff" />
        <path d="M600 470h372M620 470v-14M786 470v-14M952 470v-14M600 456h372" stroke="#8a8aff" stroke-width="3" fill="none" opacity=".6" />
        <path d="M1012 660V520c0-22 14-40 36-40h54c22 0 34 8 40 22l22 64c4 12 6 24 6 36v58Z" fill="url(#tk-cab)" />
        <path d="M1086 494h22c12 0 18 6 22 16l16 48h-60Z" fill="#9ad0ff" opacity=".55" />
        <rect x="1012" y="600" width="158" height="10" fill="#ff5c00" />
        <rect x="1158" y="616" width="16" height="12" rx="2" fill="#fff2c4" />
        <polygon points="1174,616 1600,560 1600,690 1174,628" fill="#fff2c4" opacity=".08" />
        <rect x="548" y="610" width="10" height="14" rx="2" fill="#ff2a1a" />
        @foreach ([620, 702, 964, 1110] as $cx)
            <g transform="translate({{ $cx }} 668)">
                <circle r="38" fill="#050508" />
                <g class="scene__wheel">
                    <circle r="18" fill="#3a3a5a" />
                    <path d="M0-18V18M-18 0H18" stroke="#05050f" stroke-width="4" />
                </g>
            </g>
        @endforeach
    </g>
</svg>
