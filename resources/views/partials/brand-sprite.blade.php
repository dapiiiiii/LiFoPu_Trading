{{-- Brand symbols referenced with <use>. Motifs follow the Brand Guideline 2025 pattern page (p.31). --}}
<svg class="lf-sprite" aria-hidden="true" focusable="false" width="0" height="0">
    <defs>
        <symbol id="lf-mark" viewBox="0 0 661.1 572.4">
            <path d="{{ App\Support\Brand::markPath() }}" />
        </symbol>

        {{-- Facing pair: the mark turned 90° and its mirror, as in the guideline patterns (p.90 to 95). --}}
        <symbol id="lf-motif-pair" viewBox="0 0 1488.8 661.1">
            <use href="#lf-mark" width="661.1" height="572.4" transform="translate(572.4 0) scale(-1 1) translate(572.4 0) rotate(90)" />
            <use href="#lf-mark" width="661.1" height="572.4" transform="translate(744.4 0) translate(572.4 0) rotate(90)" />
        </symbol>

        {{-- Star: four marks around a centre, tips outward on the diagonals. --}}
        <symbol id="lf-motif-star" viewBox="0 0 1400 1400">
            <g transform="rotate(45 700 700)">
                @foreach ([0, 90, 180, 270] as $angle)
                    <use href="#lf-mark" width="661.1" height="572.4" transform="rotate({{ $angle }} 700 700) translate(369.4 92)" />
                @endforeach
            </g>
        </symbol>

        {{-- Diamond: four marks on the compass points, tips outward. --}}
        <symbol id="lf-motif-diamond" viewBox="0 0 1400 1400">
            @foreach ([0, 90, 180, 270] as $angle)
                <use href="#lf-mark" width="661.1" height="572.4" transform="rotate({{ $angle }} 700 700) translate(468.6 10) scale(0.7)" />
            @endforeach
        </symbol>

        {{-- Pinwheel: four marks turning around their base corner. --}}
        <symbol id="lf-motif-pinwheel" viewBox="0 0 1400 1400">
            @foreach ([0, 90, 180, 270] as $angle)
                <use href="#lf-mark" width="661.1" height="572.4" transform="rotate({{ $angle }} 700 700) translate(700 127.6) scale(0.95)" />
            @endforeach
        </symbol>

        {{-- Pairs: four marks pointing to the corners. --}}
        <symbol id="lf-motif-pairs" viewBox="0 0 1400 1400">
            @foreach ([-45, 45, 135, 225] as $angle)
                <use href="#lf-mark" width="661.1" height="572.4" transform="rotate({{ $angle }} 700 700) translate(501.7 80) scale(0.6)" />
            @endforeach
        </symbol>
    </defs>
</svg>
