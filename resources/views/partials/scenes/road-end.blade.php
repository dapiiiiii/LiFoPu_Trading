{{-- Straight road to a sunrise horizon with a kilometre post. Pass $km to change the post. --}}
<svg class="scene scene--road-end" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
    <defs>
        <linearGradient id="re-sky" x1="0" y1="0" x2="0" y2="560" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#0e0d0c" />
            <stop offset=".7" stop-color="#3a2216" />
            <stop offset="1" stop-color="#e2793a" />
        </linearGradient>
        <radialGradient id="re-sun" cx="800" cy="560" r="420" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#ffe0a6" stop-opacity=".9" />
            <stop offset=".3" stop-color="#f08a3c" stop-opacity=".3" />
            <stop offset="1" stop-color="#d84500" stop-opacity="0" />
        </radialGradient>
    </defs>
    <rect width="1600" height="560" fill="url(#re-sky)" />
    <rect width="1600" height="900" fill="url(#re-sun)" />
    <path fill="#4a2a1a" d="M0 560V532l120-8 40-16h150l40 14 200 10 100-12 120 2 180 12 120-14 40-12h160l30 12 140 6 160 8v26Z" />
    <rect y="560" width="1600" height="340" fill="#110d0b" />
    <polygon points="800,560 300,900 1300,900" fill="#1f1b18" />
    <path class="scene__route" d="M800 560V900" stroke="#ff7a2e" stroke-width="3" pathLength="1" />
    <g fill="#f3ead9" opacity=".85"><polygon points="799,600 801,600 802.6,640 797.4,640" /><polygon points="797.5,690 802.5,690 805,760 795,760" /><polygon points="795,830 805,830 808,900 792,900" /></g>
    <g transform="translate(1180 600)">
        <rect x="-6" y="0" width="12" height="190" fill="#2a2420" />
        <rect x="-60" y="-70" width="120" height="84" rx="6" fill="#f2ede6" />
        <use href="#lf-mark" x="-44" y="-58" width="26" height="22" fill="#d84500" />
        <text x="-12" y="-38" font-size="20" fill="#0d0c0b" class="scene__km-label">KM</text>
        <text x="0" y="0" font-size="34" text-anchor="middle" fill="#0d0c0b" class="scene__km-value">{{ $km ?? '00' }}</text>
    </g>
</svg>
