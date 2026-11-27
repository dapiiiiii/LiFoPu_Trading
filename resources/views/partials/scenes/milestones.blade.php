{{-- History: four illustrated prints, one per milestone (home.glance.route), fanned like a hand of photos. Decorative. --}}
@php $stops = trans('home.glance.route'); @endphp
<div class="scene scene--milestones" aria-hidden="true">
    <div class="milestones__deck">

        {{-- 2013: transport at dawn --}}
        <figure class="mcard" style="--i: 0; --r: -9deg; --y: 5%">
            <div class="mcard__pic">
                <svg viewBox="0 0 200 150" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <defs><linearGradient id="ms-sky-1" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#1b2350" /><stop offset=".62" stop-color="#d9733a" /><stop offset="1" stop-color="#f7b366" /></linearGradient></defs>
                    <rect width="200" height="150" fill="url(#ms-sky-1)" />
                    <circle cx="100" cy="98" r="18" fill="#ffe2b0" />
                    <rect y="98" width="200" height="52" fill="#2a2622" />
                    <polygon points="94,98 106,98 160,150 40,150" fill="#171513" />
                    <path d="M100 104v6M100 116v9M100 132v13" stroke="#e2b54a" stroke-width="2" />
                    <g transform="translate(122 84)">
                        <rect width="44" height="15" rx="7.5" fill="#0d0c0b" />
                        <rect y="6.5" width="44" height="2" fill="#d84500" />
                        <path d="M45 3h9l5 6v6H45z" fill="#0d0c0b" />
                        <circle cx="8" cy="16" r="3.2" fill="#0d0c0b" /><circle cx="17" cy="16" r="3.2" fill="#0d0c0b" /><circle cx="52" cy="16" r="3.2" fill="#0d0c0b" />
                    </g>
                </svg>
            </div>
            <figcaption><b>{{ $stops[0]['marker'] }}</b><span>{{ $stops[0]['label'] }}</span></figcaption>
        </figure>

        {{-- Then: construction machinery rental, golden hour --}}
        <figure class="mcard" style="--i: 1; --r: -3deg; --y: -3%">
            <div class="mcard__pic">
                <svg viewBox="0 0 200 150" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <defs><linearGradient id="ms-sky-2" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#f8e7bf" /><stop offset="1" stop-color="#e4b45c" /></linearGradient></defs>
                    <rect width="200" height="150" fill="url(#ms-sky-2)" />
                    <circle cx="150" cy="46" r="14" fill="#fff4dc" />
                    <path d="M0 104C40 84 70 92 104 98s70-18 96-8v60H0z" fill="#c69822" opacity=".55" />
                    <rect y="118" width="200" height="32" fill="#7a5c0f" />
                    <path d="M18 118l14-10h22l10 10z" fill="#a07a1c" />
                    <g transform="translate(70 76)">
                        <rect x="0" y="34" width="64" height="12" rx="6" fill="#171513" />
                        <rect x="10" y="16" width="42" height="18" rx="2" fill="#d84500" />
                        <rect x="38" y="4" width="16" height="16" rx="2" fill="#171513" />
                        <rect x="41" y="7" width="9" height="7" fill="#f8e7bf" opacity=".85" />
                        <path d="M14 20L-12 -2L-26 22" fill="none" stroke="#171513" stroke-width="6" stroke-linejoin="round" />
                        <path d="M-32 18h14l-4 12h-8z" fill="#171513" />
                    </g>
                </svg>
            </div>
            <figcaption><b>{{ $stops[1]['marker'] }}</b><span>{{ $stops[1]['label'] }}</span></figcaption>
        </figure>

        {{-- 2023: petroleum retail, a forecourt at dusk --}}
        <figure class="mcard" style="--i: 2; --r: 4deg; --y: -4%">
            <div class="mcard__pic">
                <svg viewBox="0 0 200 150" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <defs><linearGradient id="ms-sky-3" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#2b1a12" /><stop offset=".7" stop-color="#b03a00" /><stop offset="1" stop-color="#f39a4a" /></linearGradient></defs>
                    <rect width="200" height="150" fill="url(#ms-sky-3)" />
                    <rect y="112" width="200" height="38" fill="#17110d" />
                    <ellipse cx="100" cy="114" rx="80" ry="12" fill="#ffd6ad" opacity=".28" />
                    <rect x="26" y="52" width="148" height="12" fill="#f6f1ea" />
                    <rect x="26" y="61" width="148" height="3" fill="#d84500" />
                    <rect x="42" y="64" width="5" height="48" fill="#f6f1ea" /><rect x="153" y="64" width="5" height="48" fill="#f6f1ea" />
                    <g fill="#f6f1ea"><rect x="72" y="84" width="16" height="28" rx="2" /><rect x="112" y="84" width="16" height="28" rx="2" /></g>
                    <g fill="#d84500"><rect x="75" y="88" width="10" height="6" /><rect x="115" y="88" width="10" height="6" /></g>
                    <rect x="92" y="40" width="16" height="12" fill="#d84500" />
                </svg>
            </div>
            <figcaption><b>{{ $stops[2]['marker'] }}</b><span>{{ $stops[2]['label'] }}</span></figcaption>
        </figure>

        {{-- Now: integrated energy, four lanes meeting under a new sun --}}
        <figure class="mcard mcard--now" style="--i: 3; --r: 10deg; --y: 6%">
            <div class="mcard__pic">
                <svg viewBox="0 0 200 150" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <defs><linearGradient id="ms-sky-4" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#000042" /><stop offset=".6" stop-color="#3b2f9a" /><stop offset="1" stop-color="#ffb36b" /></linearGradient></defs>
                    <rect width="200" height="150" fill="url(#ms-sky-4)" />
                    <circle cx="100" cy="96" r="30" fill="#ffb36b" opacity=".35" />
                    <circle cx="100" cy="96" r="19" fill="#ffd9a8" />
                    <rect y="96" width="200" height="54" fill="#0d0c0b" />
                    <g stroke-width="2.5" fill="none">
                        <path d="M100 98L20 150" stroke="#d84500" /><path d="M100 98L74 150" stroke="#c69822" />
                        <path d="M100 98L126 150" stroke="#ff5c00" /><path d="M100 98L180 150" stroke="#e2b54a" />
                    </g>
                    <use href="#lf-mark" x="84" y="30" width="32" height="28" fill="#ff7a3d" />
                </svg>
            </div>
            <figcaption><b>{{ $stops[3]['marker'] }}</b><span>{{ $stops[3]['label'] }}</span></figcaption>
        </figure>

    </div>
</div>
