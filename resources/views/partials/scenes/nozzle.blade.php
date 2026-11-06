{{-- Fuel retail: an orange fuel nozzle floating over a forecourt at dusk. A drop forms at the spout, falls and ripples
     on the ground. The forecourt behind is out of focus to give the nozzle depth. Illustration, not a specific site. --}}
@php
    // Out-of-focus forecourt lights: [x, y, radius, warm?].
    $bokeh = [[140, 470, 34, 1], [260, 560, 18, 0], [420, 500, 46, 1], [610, 590, 22, 1], [700, 470, 14, 0], [980, 560, 30, 1],
        [1090, 470, 18, 0], [1210, 600, 40, 1], [1330, 520, 22, 1], [1470, 580, 50, 1], [1540, 470, 16, 0], [890, 620, 12, 1]];
    $sparks = [[620, 470], [760, 520], [930, 450], [1040, 500], [700, 380], [1150, 420]];
@endphp
<svg class="scene scene--nozzle" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false">
    <defs>
        <linearGradient id="nz-sky" x1="0" y1="0" x2="0" y2="660" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#0b0a10" />
            <stop offset=".5" stop-color="#21140f" />
            <stop offset=".85" stop-color="#6b2c11" />
            <stop offset="1" stop-color="#b24a17" />
        </linearGradient>
        <linearGradient id="nz-floor" x1="0" y1="660" x2="0" y2="900" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#2e1c14" />
            <stop offset="1" stop-color="#060404" />
        </linearGradient>
        <radialGradient id="nz-glow" cx="820" cy="420" r="660" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#ff7a3d" stop-opacity=".42" />
            <stop offset=".45" stop-color="#d84500" stop-opacity=".14" />
            <stop offset="1" stop-color="#d84500" stop-opacity="0" />
        </radialGradient>
        <radialGradient id="nz-sheen">
            <stop offset="0" stop-color="#ff9a5c" stop-opacity=".3" />
            <stop offset="1" stop-color="#ff9a5c" stop-opacity="0" />
        </radialGradient>
        <radialGradient id="nz-bokeh-warm">
            <stop offset="0" stop-color="#ffd59a" stop-opacity=".7" />
            <stop offset=".6" stop-color="#ffb05c" stop-opacity=".35" />
            <stop offset="1" stop-color="#ff9a3d" stop-opacity="0" />
        </radialGradient>
        <radialGradient id="nz-bokeh-cool">
            <stop offset="0" stop-color="#ffffff" stop-opacity=".6" />
            <stop offset=".6" stop-color="#fff2e0" stop-opacity=".25" />
            <stop offset="1" stop-color="#fff2e0" stop-opacity="0" />
        </radialGradient>
        <radialGradient id="nz-shadow">
            <stop offset="0" stop-color="#000" stop-opacity=".7" />
            <stop offset="1" stop-color="#000" stop-opacity="0" />
        </radialGradient>
        {{-- The body reads as a lit cylinder: bright along the top, falling into shadow underneath. --}}
        <linearGradient id="nz-body" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0" stop-color="#ffb07a" />
            <stop offset=".12" stop-color="#ff7a3d" />
            <stop offset=".45" stop-color="#e2520a" />
            <stop offset=".8" stop-color="#a83600" />
            <stop offset="1" stop-color="#5e1d00" />
        </linearGradient>
        <linearGradient id="nz-chrome" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0" stop-color="#5b5550" />
            <stop offset=".2" stop-color="#f6f1eb" />
            <stop offset=".36" stop-color="#a39a91" />
            <stop offset=".58" stop-color="#3a3532" />
            <stop offset=".8" stop-color="#d4cbc2" />
            <stop offset="1" stop-color="#4a4440" />
        </linearGradient>
        <linearGradient id="nz-black" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0" stop-color="#574e48" />
            <stop offset=".3" stop-color="#1f1a18" />
            <stop offset="1" stop-color="#0a0807" />
        </linearGradient>
        <radialGradient id="nz-fuel" cx=".38" cy=".7" r=".75">
            <stop offset="0" stop-color="#fff1b8" />
            <stop offset=".35" stop-color="#ffc24a" />
            <stop offset="1" stop-color="#c26a00" />
        </radialGradient>
        <radialGradient id="nz-spec">
            <stop offset="0" stop-color="#fff" stop-opacity=".55" />
            <stop offset="1" stop-color="#fff" stop-opacity="0" />
        </radialGradient>
        <filter id="nz-far" x="-10%" y="-20%" width="120%" height="140%"><feGaussianBlur stdDeviation="7" /></filter>
    </defs>

    {{-- Backdrop --}}
    <rect width="1600" height="660" fill="url(#nz-sky)" />
    <rect width="1600" height="900" fill="url(#nz-glow)" />

    {{-- Flow meter rings behind the nozzle --}}
    <g class="nz__meter nz__subject" fill="none">
        <circle cx="820" cy="410" r="300" stroke="#fff0e6" stroke-opacity=".07" stroke-width="1.5" />
        <circle class="nz__ticks" cx="820" cy="410" r="338" stroke="#fff0e6" stroke-opacity=".12" stroke-width="14" pathLength="120" stroke-dasharray=".12 .88" />
        <circle class="nz__arc" cx="820" cy="410" r="300" stroke="#ff7a3d" stroke-width="3" stroke-linecap="round" pathLength="1" transform="rotate(-90 820 410)" />
    </g>

    {{-- The forecourt, out of focus --}}
    <g class="nz__far" filter="url(#nz-far)" opacity=".6">
        <polygon points="-40,206 700,206 660,232 -40,232" fill="#1c1715" />
        <rect x="-40" y="150" width="740" height="58" fill="#d84500" />
        <rect x="-40" y="150" width="740" height="6" fill="#ff9a5c" />
        @foreach ([90, 250, 430, 590] as $x)
            <rect x="{{ $x - 30 }}" y="222" width="60" height="7" rx="3" fill="#fff4dd" />
        @endforeach
        @foreach ([150, 520] as $x)
            <rect x="{{ $x - 10 }}" y="232" width="20" height="430" fill="#6e625a" />
            <polygon points="{{ $x - 120 }},232 {{ $x + 120 }},232 {{ $x + 260 }},660 {{ $x - 260 }},660" fill="#fff2d9" opacity=".14" />
        @endforeach
        <rect x="1390" y="250" width="72" height="410" fill="#211d1b" />
        <rect x="1390" y="250" width="72" height="110" fill="#d84500" />
        <rect x="1404" y="390" width="44" height="22" fill="#ffb347" />
        <rect x="1404" y="424" width="44" height="22" fill="#ffb347" />
    </g>
    <path fill="#2b170f" d="M0 660V622l120-8 60-18h150l50 16 200 6 80-12h170l40 14 210 8 120-14 40-12h140l50 12 160 8 60-4v62Z" />

    <g class="nz__bokeh">
        @foreach ($bokeh as $i => [$x, $y, $r, $warm])
            <circle cx="{{ $x }}" cy="{{ $y }}" r="{{ $r }}" fill="url(#nz-bokeh-{{ $warm ? 'warm' : 'cool' }})" style="--i: {{ $i }}" />
        @endforeach
    </g>

    {{-- Ground --}}
    <rect y="660" width="1600" height="240" fill="url(#nz-floor)" />
    <rect y="660" width="1600" height="2" fill="#ff7a3d" opacity=".45" />
    <ellipse cx="800" cy="676" rx="780" ry="70" fill="url(#nz-sheen)" />

    {{-- The subject: shadow, puddle, nozzle and drop move together (page heroes shift them right of the headline). --}}
    <g class="nz__subject">
        <ellipse class="nz__shadow" cx="840" cy="770" rx="400" ry="30" fill="url(#nz-shadow)" />
        <ellipse cx="311" cy="764" rx="64" ry="9" fill="#ffc24a" opacity=".22" />
        <ellipse class="nz__ripple" cx="311" cy="764" rx="70" ry="12" fill="none" stroke="#ffc24a" stroke-width="2" />
        <ellipse class="nz__ripple nz__ripple--late" cx="311" cy="764" rx="70" ry="12" fill="none" stroke="#ffc24a" stroke-width="1.5" />

        <g class="nz__float">
            {{-- Nozzle, drawn facing left in its own units and placed with one transform. --}}
            <g transform="translate(800 380) rotate(-6) scale(1.15) translate(-120 -80)">
                {{-- Hose, leaving the frame to the top right --}}
                <path d="M536 38C640 38 720 10 780-110S880-380 1010-450" fill="none" stroke="#120f0e" stroke-width="58" stroke-linecap="round" />
                <path d="M536 38C640 38 720 10 780-110S880-380 1010-450" fill="none" stroke="#6a5f58" stroke-width="8" stroke-linecap="round" opacity=".55" transform="translate(-9 -14)" />
                <rect x="528" y="2" width="44" height="72" rx="9" fill="url(#nz-black)" />
                @foreach ([540, 552] as $x)
                    <rect x="{{ $x }}" y="2" width="4" height="72" fill="#000" opacity=".45" />
                @endforeach

                {{-- Swivel --}}
                <rect x="472" y="8" width="64" height="60" rx="10" fill="url(#nz-chrome)" />
                @foreach ([488, 504, 520] as $x)
                    <rect x="{{ $x }}" y="8" width="3" height="60" fill="#2a2522" opacity=".55" />
                @endforeach

                {{-- Spout: a chrome tube with a spring near the body, bending down at the tip --}}
                <g transform="translate(10 112) rotate(-3)">
                    <rect x="-252" y="-15" width="266" height="30" rx="6" fill="url(#nz-chrome)" />
                    @for ($x = -64; $x <= -12; $x += 7)
                        <rect x="{{ $x }}" y="-17" width="3" height="34" rx="1.5" fill="#2a2522" opacity=".7" />
                    @endfor
                    <g transform="translate(-250 0) rotate(-28)">
                        <rect x="-92" y="-13" width="98" height="26" rx="6" fill="url(#nz-chrome)" />
                        <ellipse cx="-91" cy="0" rx="5" ry="12" fill="#14100e" />
                    </g>
                    <circle cx="-250" cy="0" r="15" fill="url(#nz-chrome)" />
                </g>

                {{-- Guard and lever --}}
                <path d="M150 140C250 196 410 178 476 64" fill="none" stroke="#a83600" stroke-width="20" stroke-linecap="round" />
                <path d="M150 140C250 196 410 178 476 64" fill="none" stroke="#ff9a5c" stroke-width="4" stroke-linecap="round" opacity=".55" transform="translate(0 -7)" />
                <path d="M196 96C280 122 370 116 440 78" fill="none" stroke="#161210" stroke-width="18" stroke-linecap="round" />
                <path d="M196 96C280 122 370 116 440 78" fill="none" stroke="#6a5f58" stroke-width="4" stroke-linecap="round" opacity=".7" transform="translate(0 -5)" />

                {{-- Grip and head --}}
                <path d="M150 4H448C468 4 482 18 482 38S468 72 448 72H150Z" fill="url(#nz-body)" />
                @for ($x = 214; $x <= 430; $x += 14)
                    <rect x="{{ $x }}" y="54" width="4" height="14" rx="2" fill="#5e1d00" opacity=".45" />
                @endfor
                <path d="M40 0H160C176 0 186 10 186 26V122C186 140 172 152 154 152H44C20 152 2 134 4 110L10 36C12 14 24 0 40 0Z" fill="url(#nz-body)" />
                <path d="M28 10C48 2 120 3 160 4H446C462 4 474 10 479 20" fill="none" stroke="#fff3e8" stroke-width="3" stroke-linecap="round" opacity=".6" />
                <ellipse cx="54" cy="34" rx="34" ry="13" fill="url(#nz-spec)" transform="rotate(-18 54 34)" />

                {{-- Sight glass --}}
                <circle cx="96" cy="74" r="34" fill="url(#nz-chrome)" />
                <circle cx="96" cy="74" r="28" fill="#120c0a" />
                <ellipse cx="86" cy="60" rx="14" ry="6" fill="#fff" opacity=".22" transform="rotate(-24 86 60)" />
            </g>

            {{-- A drop forms at the spout tip and falls --}}
            <g transform="translate(311 538)">
                <g class="nz__drop">
                    <path d="M0 0C7 12 13 20 13 29A13 13 0 0 1-13 29C-13 20-7 12 0 0Z" fill="url(#nz-fuel)" />
                    <ellipse cx="-4" cy="27" rx="3.5" ry="6" fill="#fff" opacity=".8" />
                </g>
            </g>
        </g>

        <g class="nz__sparks" fill="#ffb46b">
            @foreach ($sparks as $i => [$x, $y])
                <circle cx="{{ $x }}" cy="{{ $y }}" r="{{ 2 + $i % 2 }}" style="--i: {{ $i }}" />
            @endforeach
        </g>
    </g>
</svg>
