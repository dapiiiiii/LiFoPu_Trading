{{-- Dawn highway poster. Same camera as the 3D hero (38° FOV, eye 1.7 m in the left lane, horizon at 62%,
     focal 1307 px on a 1600 × 900 frame) so the fallback frames identically. --}}
<svg class="scene scene--dawn" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true" focusable="false" data-parallax>
    <defs>
        <linearGradient id="dawn-sky" x1="0" y1="0" x2="0" y2="560" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#0b1230" />
            <stop offset=".32" stop-color="#1f2540" />
            <stop offset=".55" stop-color="#4b4038" />
            <stop offset=".74" stop-color="#a65b33" />
            <stop offset=".9" stop-color="#e2793a" />
            <stop offset="1" stop-color="#f7b366" />
        </linearGradient>
        <radialGradient id="dawn-sun" cx="1150" cy="548" r="560" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#fff3d6" stop-opacity="1" />
            <stop offset=".05" stop-color="#ffd793" stop-opacity=".9" />
            <stop offset=".22" stop-color="#f39a4a" stop-opacity=".38" />
            <stop offset="1" stop-color="#d84500" stop-opacity="0" />
        </radialGradient>
        <linearGradient id="dawn-ground" x1="0" y1="556" x2="0" y2="900" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#5a3420" />
            <stop offset=".25" stop-color="#2c1a11" />
            <stop offset="1" stop-color="#0c0806" />
        </linearGradient>
        <linearGradient id="dawn-road" x1="0" y1="560" x2="0" y2="900" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#b8784f" />
            <stop offset=".12" stop-color="#4d3a30" />
            <stop offset=".5" stop-color="#211d1b" />
            <stop offset="1" stop-color="#121110" />
        </linearGradient>
        <linearGradient id="dawn-haze" x1="0" y1="440" x2="0" y2="640" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#f6a75a" stop-opacity="0" />
            <stop offset=".55" stop-color="#f6a75a" stop-opacity=".42" />
            <stop offset="1" stop-color="#f6a75a" stop-opacity="0" />
        </linearGradient>
        <radialGradient id="dawn-tank" cx="1243" cy="480" r="120" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#1a2366" />
            <stop offset=".7" stop-color="#0a0f36" />
            <stop offset="1" stop-color="#05071c" />
        </radialGradient>
        <linearGradient id="dawn-rim" x1="1152" y1="0" x2="1334" y2="0" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#ffd59a" stop-opacity="1" />
            <stop offset=".5" stop-color="#ffb366" stop-opacity=".7" />
            <stop offset="1" stop-color="#ffb366" stop-opacity=".2" />
        </linearGradient>
        <linearGradient id="dawn-shadow" x1="0" y1="683" x2="0" y2="820" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#000" stop-opacity=".55" />
            <stop offset="1" stop-color="#000" stop-opacity="0" />
        </linearGradient>
        <filter id="dawn-glow" x="-50%" y="-50%" width="200%" height="200%">
            <feGaussianBlur stdDeviation="3" result="b" />
            <feMerge><feMergeNode in="b" /><feMergeNode in="SourceGraphic" /></feMerge>
        </filter>
    </defs>

    <g data-depth="0">
        <rect width="1600" height="560" fill="url(#dawn-sky)" />
        <rect width="1600" height="900" fill="url(#dawn-sun)" />
        <circle cx="1150" cy="548" r="24" fill="#fff4dc" />
    </g>

    {{-- Highland silhouettes with flat-topped ambas --}}
    <g data-depth="0.06">
        <path fill="#c97a4a" fill-opacity=".55" d="M0 560V520l60-8 35-14h75l35 12h55l40-22h110l30 16h80l40 14h80l50-17h70l30 11h90l50 12h70l50-4 70-18 30-20h120l30 16h80l40-12h80l30 14 70 4v46Z" />
    </g>
    <g data-depth="0.12">
        <path fill="#6e3a24" fill-opacity=".9" d="M0 572V530l80-2 40 12 70-4 40-14h100l30 14 90 6 70 4 80 8 100 4 120 4 80 2h280l60-12 60-12 50-14h110l30 12 70 4 40 4v32Z" />
    </g>
    <rect y="440" width="1600" height="200" fill="url(#dawn-haze)" data-depth="0.12" />

    <g data-depth="0.22">
        <rect y="556" width="1600" height="344" fill="url(#dawn-ground)" />
        <polygon points="960,560 620,900 1600,900 1600,751" fill="url(#dawn-road)" />
        <ellipse cx="1060" cy="612" rx="60" ry="70" fill="#ff9a4d" opacity=".2" />
        {{-- Edge lines --}}
        <polygon points="960,560 648,900 672,900" fill="#e9d9c6" opacity=".55" />
        <polygon points="960.5,560 1600,750 1600,766" fill="#e9d9c6" opacity=".5" />
        {{-- Route line: the orange line that traces the road ahead --}}
        <polyline class="scene__route" points="1360,900 1221,782 1123,699 1065,649 1037,625 1021,612 1010,603 1001,596 997,592 962,561" fill="none" stroke="#ff7a2e" stroke-width="2.5" filter="url(#dawn-glow)" pathLength="1" />
        {{-- Centre dashes (3 m dash, 6 m gap) --}}
        <g fill="#f3ead9" opacity=".85">
            <polygon points="1319.4,877.4 1347.4,877.4 1231.2,782.2 1211.6,782.2" />
            <polygon points="1117.3,698.9 1129.5,698.9 1102.8,677 1092.4,677" />
            <polygon points="1060.7,648.9 1068.5,648.9 1056.9,639.4 1049.9,639.4" />
            <polygon points="1034,625.4 1039.8,625.4 1033.2,620 1028,620" />
            <polygon points="1018.5,611.7 1023.1,611.7 1018.9,608.3 1014.7,608.3" />
            <polygon points="1008.4,602.7 1012.2,602.7 1009.3,600.4 1005.7,600.4" />
            <polygon points="1001.3,596.4 1004.5,596.4 1002.3,594.7 999.3,594.7" />
            <polygon points="995.9,591.7 998.7,591.7 997.1,590.4 994.5,590.4" />
        </g>
    </g>

    {{-- Utility poles on the right shoulder, 18 m apart --}}
    <g data-depth="0.3" fill="#0d0907">
        <rect x="1507.5" y="148" width="16" height="523" /><rect x="1450" y="172" width="131" height="5" />
        <rect x="1324.8" y="285" width="11" height="349" /><rect x="1286.8" y="301" width="87" height="4" />
        <rect x="1188" y="388" width="7" height="218" /><rect x="1164.3" y="397" width="54" height="3" />
        <rect x="1125.8" y="435" width="5" height="159" /><rect x="1108.3" y="442" width="40" height="2" />
        <rect x="1090.3" y="462" width="4" height="124" /><rect x="1076.8" y="467" width="31" height="2" />
        <rect x="1067.4" y="479" width="3" height="103" /><rect x="1055.9" y="483" width="26" height="1.5" />
        <rect x="1051.3" y="491" width="2.6" height="88" /><rect x="1041.6" y="494" width="22" height="1.3" />
        <g fill="none" stroke="#0d0907" stroke-width="1.2">
            <path d="M1450 174Q1340 260 1286.8 303Q1210 360 1164.3 398Q1125 430 1108.3 443Q1085 460 1076.8 468Q1062 478 1055.9 484Q1046 490 1041.6 495" />
            <path d="M1581 174Q1440 260 1373.8 303Q1260 360 1218.3 398Q1165 430 1148.3 443Q1118 460 1107.8 468Q1088 478 1081.9 484Q1068 490 1063.6 495" />
        </g>
    </g>

    {{-- LiFoPu Transport tanker, rear view, 18 m ahead in the right lane --}}
    <g class="scene__tanker" data-depth="0.38">
        <polygon points="1152,683 1334,683 1420,820 1080,820" fill="url(#dawn-shadow)" />
        <rect x="1160" y="603" width="167" height="23" fill="#07091c" />
        <ellipse cx="1243" cy="527" rx="91" ry="73" fill="url(#dawn-tank)" />
        <ellipse cx="1243" cy="527" rx="85.5" ry="67.5" fill="none" stroke="#ff5c00" stroke-width="5.5" opacity=".85" />
        <path d="M1152 527A91 73 0 0 1 1334 527" fill="none" stroke="url(#dawn-rim)" stroke-width="2.5" />
        <use href="#lf-mark" x="1214.7" y="501" width="56.6" height="49" fill="#ffffff" />
        <g fill="#141a3a">
            <rect x="1276" y="451" width="2.4" height="174" /><rect x="1294" y="451" width="2.4" height="174" />
            @for ($y = 470; $y < 625; $y += 24)
                <rect x="1276" y="{{ $y }}" width="20" height="2" />
            @endfor
        </g>
        <path d="M1185 447h116M1193 447v-6M1243 447v-6M1293 447v-6" stroke="#ffcf8f" stroke-width="1.6" opacity=".7" />
        <rect x="1164" y="646" width="42" height="37.5" rx="7" fill="#050505" />
        <rect x="1280" y="646" width="42" height="37.5" rx="7" fill="#050505" />
        <rect x="1163" y="650" width="44" height="30" fill="#0b0b0b" />
        <rect x="1279" y="650" width="44" height="30" fill="#0b0b0b" />
        <rect x="1155" y="625" width="176" height="11" fill="#10131f" />
        <rect x="1189" y="627" width="108" height="4" fill="#c8501d" opacity=".85" />
        <g class="scene__lights">
            <rect x="1160.6" y="616.5" width="20" height="9" rx="2" fill="#ff3b1f" />
            <rect x="1305.8" y="616.5" width="20" height="9" rx="2" fill="#ff3b1f" />
            <circle cx="1170.6" cy="621" r="13" fill="#ff3b1f" opacity=".25" />
            <circle cx="1315.8" cy="621" r="13" fill="#ff3b1f" opacity=".25" />
            <circle cx="1157" cy="604" r="2" fill="#ffae3b" /><circle cx="1330" cy="604" r="2" fill="#ffae3b" />
        </g>
    </g>
</svg>
