{{-- Line icons in the style of the Company Profile service icons (p.7). --}}
<svg class="thumb" viewBox="0 0 120 120" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
    @switch($scene)
        @case('station')
            <path d="M28 96 50 66" />
            <path d="M44 62 62 40a6 6 0 0 1 8 0l14 13a6 6 0 0 1 0 8L66 84a6 6 0 0 1-8 0L44 70a6 6 0 0 1 0-8Z" />
            <path d="m71 42 17-17M55 72l8-8" />
            <path d="M98 54s-8 10-8 15a8 8 0 0 0 16 0c0-5-8-15-8-15Z" />
            @break
        @case('oil')
            <path d="M28 40h30l10 10v50a4 4 0 0 1-4 4H28a4 4 0 0 1-4-4V44a4 4 0 0 1 4-4Z" />
            <path d="M34 40V30h12v10M50 30h10l6 8" />
            <path d="M44 62s-9 11-9 17a9 9 0 0 0 18 0c0-6-9-17-9-17Z" />
            <path d="M78 56h14a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4H78a4 4 0 0 1-4-4V60a4 4 0 0 1 4-4ZM80 56V46h10v10" />
            <path d="M85 72s-6 7-6 11a6 6 0 0 0 12 0c0-4-6-11-6-11Z" />
            @break
        @case('tanker')
            <rect x="12" y="42" width="66" height="34" rx="17" />
            <path d="M78 50h16l10 14v18H78ZM84 55h8l6 9H84Z" />
            <path d="M10 82h96M30 42v-6h12v6" />
            <circle cx="26" cy="88" r="7" /><circle cx="44" cy="88" r="7" /><circle cx="92" cy="88" r="7" />
            <path d="M54 51s-6 7-6 11a6 6 0 0 0 12 0c0-4-6-11-6-11Z" />
            @break
        @case('ev')
            <rect x="22" y="20" width="44" height="80" rx="6" />
            <path d="M22 44h44M16 100h56" />
            <path d="m48 54-9 15h10l-6 14 14-19H46l5-10Z" />
            <path d="M66 40h10a8 8 0 0 1 8 8v30a6 6 0 0 0 12 0V52" />
            <path d="M90 34v10M102 34v10M86 44h20v6a10 10 0 0 1-20 0Z" />
            @break
        @case('coffee')
            <ellipse cx="46" cy="54" rx="20" ry="29" transform="rotate(-28 46 54)" />
            <path d="M58 30c-10 10 2 24-10 48" />
            <ellipse cx="78" cy="76" rx="18" ry="26" transform="rotate(38 78 76)" />
            <path d="M62 62c14 2 14 18 32 26" />
            @break
    @endswitch
</svg>
