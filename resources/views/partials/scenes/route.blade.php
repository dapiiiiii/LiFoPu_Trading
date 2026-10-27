{{-- Depot-to-destination route. The tanker follows the road as the section scrolls (resources/js/modules/moments.js). Schematic, not a real route. --}}
@php $stops = trans('services.items.fuel-transportation.route'); @endphp
<div class="route" data-route>
    <svg class="route__svg" viewBox="0 0 1600 600" preserveAspectRatio="xMidYMid meet" aria-hidden="true" focusable="false">
        <path id="route-road" d="M120 420C360 420 420 220 700 220S1040 400 1280 380 1440 260 1500 240" fill="none" stroke="#11113a" stroke-width="44" stroke-linecap="round" />
        <path d="M120 420C360 420 420 220 700 220S1040 400 1280 380 1440 260 1500 240" fill="none" stroke="#3a3a8a" stroke-width="2" stroke-dasharray="16 20" />
        <path class="route__progress" d="M120 420C360 420 420 220 700 220S1040 400 1280 380 1440 260 1500 240" fill="none" stroke="#ff5c00" stroke-width="4" stroke-linecap="round" pathLength="1" data-route-progress />
        <path d="M1280 380C1320 440 1420 470 1500 480" fill="none" stroke="#11113a" stroke-width="30" stroke-linecap="round" />

        <g class="route__stop" transform="translate(120 420)">
            <rect x="-46" y="-120" width="92" height="80" rx="4" fill="none" stroke="#8a8aff" stroke-width="2" />
            <ellipse cx="0" cy="-120" rx="46" ry="10" fill="none" stroke="#8a8aff" stroke-width="2" />
            <circle r="12" fill="#000080" stroke="#ff5c00" stroke-width="3" />
        </g>
        <g class="route__stop" transform="translate(1500 240)">
            <path d="M-60-120h120M-50-120v84M50-120v84" stroke="#8a8aff" stroke-width="2" />
            <rect x="-60" y="-132" width="120" height="14" fill="#ff5c00" />
            <circle r="12" fill="#000080" stroke="#ff5c00" stroke-width="3" />
        </g>
        <g class="route__stop" transform="translate(1500 480)">
            <rect x="-50" y="-96" width="100" height="70" fill="none" stroke="#8a8aff" stroke-width="2" />
            <path d="M-30-96v-24h20v24" stroke="#8a8aff" stroke-width="2" fill="none" />
            <circle r="12" fill="#000080" stroke="#ff5c00" stroke-width="3" />
        </g>

        <g class="route__tanker" data-route-tanker>
            <g transform="translate(-60 -34)">
                <rect x="0" y="6" width="84" height="40" rx="20" fill="#000080" stroke="#8a8aff" stroke-width="2" />
                <rect x="6" y="28" width="72" height="5" fill="#ff5c00" />
                <use href="#lf-mark" x="30" y="12" width="20" height="17" fill="#fff" />
                <path d="M84 14h18l14 16v22H84Z" fill="#00005a" stroke="#8a8aff" stroke-width="2" />
                <circle cx="18" cy="52" r="8" fill="#05050f" /><circle cx="40" cy="52" r="8" fill="#05050f" /><circle cx="104" cy="52" r="8" fill="#05050f" />
            </g>
        </g>
    </svg>
    <ol class="route__labels">
        <li style="--x: 7.5%; --y: 88%">{{ $stops[0] }}</li>
        <li style="--x: 44%; --y: 20%">{{ $stops[1] }}</li>
        <li style="--x: 93.75%; --y: 18%">{{ $stops[2] }}</li>
        <li style="--x: 93.75%; --y: 98%">{{ $stops[3] }}</li>
    </ol>
</div>
