{{-- Viscous lubricant ribbon. WebGL shader (resources/js/modules/oil.js) replaces the SVG on capable devices. --}}
<div class="scene scene--oil" data-oil>
    <svg class="scene__fallback" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
        <defs>
            <radialGradient id="oil-bg" cx="800" cy="420" r="900" gradientUnits="userSpaceOnUse">
                <stop offset="0" stop-color="#2a1d0c" />
                <stop offset="1" stop-color="#0b0805" />
            </radialGradient>
            <linearGradient id="oil-body" x1="0" y1="300" x2="0" y2="620" gradientUnits="userSpaceOnUse">
                <stop offset="0" stop-color="#fff0c2" />
                <stop offset=".18" stop-color="#e2b54a" />
                <stop offset=".45" stop-color="#c69822" />
                <stop offset=".75" stop-color="#6b4508" />
                <stop offset="1" stop-color="#241402" />
            </linearGradient>
        </defs>
        <rect width="1600" height="900" fill="url(#oil-bg)" />
        <g class="scene__ribbon">
            <path d="M-80 520C200 380 420 330 700 420s520 160 980-60v120c-420 220-700 150-980 60S160 500-80 640Z" fill="url(#oil-body)" />
            <path d="M-80 530C200 392 420 342 700 432s520 160 980-60" fill="none" stroke="#fff6da" stroke-width="5" stroke-opacity=".7" />
            <path d="M-80 600C220 470 420 440 700 520s560 140 980-50" fill="none" stroke="#3a2404" stroke-width="10" stroke-opacity=".5" />
        </g>
    </svg>
    <canvas class="scene__canvas" data-oil-canvas aria-hidden="true"></canvas>
</div>
