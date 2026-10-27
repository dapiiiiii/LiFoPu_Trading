{{-- Aerial interchange: six roads meeting at one junction, one for each customer category. --}}
<div class="scene scene--crossroads" aria-hidden="true">
    <div class="scene__relief" style="--relief: url('{{ asset('images/topo-plateau.svg') }}')"></div>
    <svg viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" focusable="false">
        <g transform="translate(1060 450)">
            @foreach ([0, 60, 120, 180, 240, 300] as $i => $angle)
                <g transform="rotate({{ $angle }})">
                    <rect x="150" y="-22" width="900" height="44" fill="#14110f" />
                    <line x1="160" y1="0" x2="1050" y2="0" stroke="#4a4038" stroke-width="2" stroke-dasharray="16 20" />
                    <line class="scene__lane" x1="160" y1="11" x2="1050" y2="11" stroke="{{ $i % 2 ? '#c69822' : '#d84500' }}" stroke-width="2.5" pathLength="1" style="--i: {{ $i }}" />
                </g>
            @endforeach
            <circle r="172" fill="none" stroke="#14110f" stroke-width="48" />
            <circle r="172" fill="none" stroke="#4a4038" stroke-width="2" stroke-dasharray="14 18" />
            <circle class="scene__ring" r="160" fill="none" stroke="#d84500" stroke-width="3" pathLength="1" />
            <circle r="120" fill="#0d0b0a" stroke="#2a241f" />
            <use href="#lf-mark" x="-42" y="-40" width="84" height="73" fill="#d84500" />
        </g>
    </svg>
</div>
