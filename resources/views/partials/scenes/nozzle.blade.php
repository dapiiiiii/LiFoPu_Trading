{{-- Fuel retail: an amber fuel nozzle floating over a forecourt at dusk. A drop forms at the spout, falls and ripples
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
        {{-- Moulded amber plastic: deeper orange in the hollow of the head, yellow where it curves to the light. --}}
        <radialGradient id="nz-body" cx=".3" cy=".5" r=".75">
            <stop offset="0" stop-color="#f58700" />
            <stop offset=".45" stop-color="#fb9d06" />
            <stop offset=".8" stop-color="#ffb512" />
            <stop offset="1" stop-color="#ffc22a" />
        </radialGradient>
        <linearGradient id="nz-band" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0" stop-color="#ffb10f" />
            <stop offset=".5" stop-color="#ffbf1f" />
            <stop offset="1" stop-color="#ff9f0a" />
        </linearGradient>
        <linearGradient id="nz-cheek" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0" stop-color="#ffe066" />
            <stop offset="1" stop-color="#ffb21a" />
        </linearGradient>
        <linearGradient id="nz-steel" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0" stop-color="#4c4e4e" />
            <stop offset=".45" stop-color="#727575" />
            <stop offset="1" stop-color="#3c3e3e" />
        </linearGradient>
        <linearGradient id="nz-rib" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0" stop-color="#3e4040" />
            <stop offset=".45" stop-color="#b8baba" />
            <stop offset=".7" stop-color="#8a8c8c" />
            <stop offset="1" stop-color="#3a3c3c" />
        </linearGradient>
        <linearGradient id="nz-black" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0" stop-color="#4a4442" />
            <stop offset=".3" stop-color="#1c1918" />
            <stop offset="1" stop-color="#050404" />
        </linearGradient>
        <filter id="nz-lift" x="-10%" y="-10%" width="125%" height="130%">
            <feDropShadow dx="0" dy="34" stdDeviation="26" flood-color="#000" flood-opacity=".55" />
        </filter>
        <radialGradient id="nz-fuel" cx=".38" cy=".7" r=".75">
            <stop offset="0" stop-color="#fff1b8" />
            <stop offset=".35" stop-color="#ffc24a" />
            <stop offset="1" stop-color="#c26a00" />
        </radialGradient>
        <filter id="nz-far" x="-10%" y="-20%" width="120%" height="140%"><feGaussianBlur stdDeviation="7" /></filter>
    </defs>

    {{-- Backdrop --}}
    <rect width="1600" height="660" fill="url(#nz-sky)" />
    <rect width="1600" height="900" fill="url(#nz-glow)" />

    {{-- Flow meter rings behind the nozzle --}}
    <g class="nz__meter nz__subject" fill="none">
        <circle cx="820" cy="410" r="240" stroke="#fff0e6" stroke-opacity=".07" stroke-width="1.5" />
        <circle class="nz__ticks" cx="820" cy="410" r="272" stroke="#fff0e6" stroke-opacity=".12" stroke-width="14" pathLength="120" stroke-dasharray=".12 .88" />
        <circle class="nz__arc" cx="820" cy="410" r="240" stroke="#ff7a3d" stroke-width="3" stroke-linecap="round" pathLength="1" transform="rotate(-90 820 410)" />
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
        <ellipse class="nz__shadow" cx="800" cy="752" rx="300" ry="24" fill="url(#nz-shadow)" />
        <ellipse cx="458" cy="750" rx="64" ry="9" fill="#ffc24a" opacity=".22" />
        <ellipse class="nz__ripple" cx="458" cy="750" rx="70" ry="12" fill="none" stroke="#ffc24a" stroke-width="2" />
        <ellipse class="nz__ripple nz__ripple--late" cx="458" cy="750" rx="70" ry="12" fill="none" stroke="#ffc24a" stroke-width="1.5" />

        {{-- Hose: from the handle down to the ground and out of frame. It stays put while the nozzle floats. --}}
        <g transform="translate(380 140) scale(.4)">
            <path d="M1790 1120C1860 1260 1900 1400 2000 1470S2300 1530 2700 1530H4200" fill="none" stroke="#0f0d0c" stroke-width="74" stroke-linecap="round" />
            <path d="M1790 1120C1860 1260 1900 1400 2000 1470S2300 1530 2700 1530H4200" fill="none" stroke="#6a605a" stroke-width="10" stroke-linecap="round" opacity=".45" transform="translate(-14 -22)" />
        </g>

        <g class="nz__float">
            {{-- Nozzle, drawn in its own units (spout to the left, handle down to the right) and placed with one transform. --}}
            <g transform="translate(380 140) scale(.4)" filter="url(#nz-lift)">
                {{-- Valve housing and trigger guard: dark grey, with the open loop the hand goes through --}}
                <path fill-rule="evenodd" fill="url(#nz-steel)" d="M1118 772L1300 700 1480 690 1700 1060C1600 1100 1460 1150 1390 1166 1330 1180 1295 1165 1275 1125L1130 820C1122 800 1118 785 1118 772ZM1300 780C1360 730 1440 700 1480 712L1650 1000C1570 1030 1480 1060 1420 1085 1385 1100 1360 1090 1350 1060 1330 990 1300 880 1300 780Z" />
                <path d="M1132 826 1278 1122C1300 1162 1336 1172 1392 1160" fill="none" stroke="#9a9c9c" stroke-width="7" stroke-linecap="round" opacity=".55" />

                {{-- Trigger lever --}}
                <path d="M1248 832C1290 800 1345 792 1365 815 1385 880 1388 990 1368 1062" fill="none" stroke="#7d8080" stroke-width="40" stroke-linecap="round" />
                <path d="M1248 832C1290 800 1345 792 1365 815 1385 880 1388 990 1368 1062" fill="none" stroke="#c9cbcb" stroke-width="7" stroke-linecap="round" opacity=".7" transform="translate(-9 -5)" />
                <path d="M1242 866 1266 862 1322 980Z" fill="#b4b6b6" />
                <circle cx="1250" cy="830" r="10" fill="#f4f4f4" />
                <circle cx="1600" cy="1062" r="10" fill="#f4f4f4" />

                {{-- Spout: a grey tube, lit from above, ribbed where the hand would grip it --}}
                @php $spout = 'M195 205C450 180 760 190 990 305'; @endphp
                <path d="{{ $spout }}" fill="none" stroke="#323434" stroke-width="104" />
                <path d="{{ $spout }}" fill="none" stroke="#6c6e6e" stroke-width="84" />
                <path d="{{ $spout }}" fill="none" stroke="#9a9c9c" stroke-width="44" transform="translate(0 -12)" />
                <path d="{{ $spout }}" fill="none" stroke="#f2f2f2" stroke-width="10" opacity=".75" transform="translate(0 -22)" />
                <path d="{{ $spout }}" fill="none" stroke="#1e2020" stroke-width="14" opacity=".5" transform="translate(0 40)" />
                @php
                    // Points along the spout curve, with the angle of the tube there.
                    $onSpout = function (float $t): array {
                        [$x0, $y0, $x1, $y1, $x2, $y2, $x3, $y3] = [195, 205, 450, 180, 760, 190, 990, 305];
                        $u = 1 - $t;
                        $x = $u ** 3 * $x0 + 3 * $u ** 2 * $t * $x1 + 3 * $u * $t ** 2 * $x2 + $t ** 3 * $x3;
                        $y = $u ** 3 * $y0 + 3 * $u ** 2 * $t * $y1 + 3 * $u * $t ** 2 * $y2 + $t ** 3 * $y3;
                        $dx = 3 * $u ** 2 * ($x1 - $x0) + 6 * $u * $t * ($x2 - $x1) + 3 * $t ** 2 * ($x3 - $x2);
                        $dy = 3 * $u ** 2 * ($y1 - $y0) + 6 * $u * $t * ($y2 - $y1) + 3 * $t ** 2 * ($y3 - $y2);

                        return [round($x, 1), round($y, 1), round(rad2deg(atan2($dy, $dx)), 1)];
                    };
                @endphp
                @for ($i = 0; $i < 8; $i++)
                    @php [$rx, $ry, $ra] = $onSpout(0.34 + $i * 0.065); @endphp
                    <g transform="translate({{ $rx }} {{ $ry }}) rotate({{ $ra }})">
                        <rect x="-17" y="-62" width="34" height="124" rx="17" fill="url(#nz-rib)" />
                        <rect x="-3" y="-50" width="5" height="72" rx="2.5" fill="#fff" opacity=".55" />
                    </g>
                @endfor

                {{-- Handle and head: moulded amber plastic --}}
                <path fill="url(#nz-body)" d="M1010 300C1020 260 1035 232 1065 226 1110 222 1150 236 1175 232 1200 215 1230 203 1270 203 1330 203 1390 225 1430 258 1462 285 1462 318 1448 332 1520 410 1580 520 1600 610 1605 640 1600 660 1590 670L1790 990C1800 1010 1795 1025 1780 1032L1705 1068C1690 1072 1680 1066 1675 1058L1490 712C1478 690 1460 676 1430 672 1350 668 1260 690 1215 712 1180 728 1150 750 1118 772 1128 700 1146 620 1140 560 1132 480 1080 430 1000 395 990 380 995 330 1010 300Z" />
                {{-- Lighter top band where the light lands --}}
                <path fill="url(#nz-band)" d="M1065 226C1110 222 1150 236 1175 232 1200 215 1230 203 1270 203 1330 203 1390 225 1430 258 1462 285 1462 318 1448 332 1520 410 1580 520 1600 610 1540 500 1450 395 1380 345 1290 290 1160 262 1050 250 1052 238 1058 229 1065 226Z" />
                {{-- The curved cheek facing the spout --}}
                <path fill="url(#nz-cheek)" d="M1060 452C1112 478 1150 556 1142 640 1138 690 1128 735 1120 768L1112 770C1088 660 1076 556 1060 452Z" />
                <path d="M1452 336C1520 410 1580 520 1600 610M1600 664 1784 994" fill="none" stroke="#ffe38a" stroke-width="6" stroke-linecap="round" opacity=".6" />
                <ellipse cx="1250" cy="232" rx="90" ry="14" fill="#fff" opacity=".35" transform="rotate(-4 1250 232)" />

                {{-- Collar where the spout enters the head --}}
                @php [$cx, $cy, $ca] = $onSpout(1); @endphp
                <g transform="translate({{ $cx - 8 }} {{ $cy }}) rotate({{ $ca }})">
                    <rect x="-36" y="-78" width="72" height="156" rx="28" fill="url(#nz-rib)" />
                    <rect x="-6" y="-62" width="8" height="96" rx="4" fill="#fff" opacity=".5" />
                </g>

                {{-- Hose stub at the end of the handle --}}
                <g transform="translate(1778 1112) rotate(58)">
                    <rect x="-78" y="-40" width="156" height="80" rx="10" fill="url(#nz-black)" />
                    <rect x="-70" y="-30" width="140" height="8" rx="4" fill="#fff" opacity=".18" />
                </g>
            </g>

            {{-- A drop forms at the spout tip and falls --}}
            <g transform="translate(458 244)">
                <g class="nz__drop">
                    <path d="M0 0C10 22 20 40 20 56A20 20 0 0 1-20 56C-20 40-10 22 0 0Z" fill="url(#nz-fuel)" />
                    <ellipse cx="-7" cy="52" rx="5" ry="10" fill="#fff" opacity=".75" />
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
