{{-- Calm documentary horizon in daylight: engraved strata, a low sun, one road. --}}
<svg class="scene scene--horizon" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
    <defs>
        <linearGradient id="hz-sky" x1="0" y1="0" x2="0" y2="600" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#e9e4dc" />
            <stop offset=".75" stop-color="#efe1cd" />
            <stop offset="1" stop-color="#f1cfa3" />
        </linearGradient>
    </defs>
    <rect width="1600" height="600" fill="url(#hz-sky)" />
    <circle cx="1120" cy="600" r="90" fill="#e7b25a" opacity=".55" />
    <circle cx="1120" cy="600" r="54" fill="#d9952f" opacity=".6" />
    <rect y="600" width="1600" height="300" fill="#e3dbd0" />
    <g fill="none" stroke="#8a7d6e" stroke-opacity=".5">
        <path d="M0 586c160-14 260-30 380-26s200 22 320 20 230-30 360-32 220 22 330 26 160-4 210-8" />
        <path d="M0 570c120-20 220-48 330-46s170 30 280 28 180-40 300-42 260 34 370 36 220-12 320-20" stroke-opacity=".3" />
        @for ($i = 0; $i < 12; $i++)
            <path d="M0 {{ 612 + $i * $i * 2.2 + $i * 6 }}H1600" stroke-opacity="{{ 0.12 + $i * 0.03 }}" />
        @endfor
    </g>
    <polygon points="800,600 560,900 1040,900" fill="#2a2420" opacity=".88" />
    <path class="scene__route" d="M800 600V900" stroke="#d84500" stroke-width="3" pathLength="1" />
    <g fill="#f3ead9"><polygon points="799,640 801,640 802.4,680 797.6,680" /><polygon points="797,720 803,720 805.5,800 794.5,800" /></g>
</svg>
