{{--
    About chapter navigation bar
    Props:
      $prevUrl, $prevNum, $prevLabel   (optional — omit for first chapter)
      $nextUrl, $nextNum, $nextLabel   (required)
      $allUrl = route('about')         (always present)
--}}
<nav class="chapter-nav" aria-label="About Us chapters">
    <div class="container chapter-nav__inner">

        {{-- All chapters button --}}
        <a href="{{ $allUrl ?? route('about') }}" class="chapter-nav__all">
            <svg viewBox="0 0 20 20" aria-hidden="true" width="16" height="16">
                <path d="M3 5h14M3 10h14M3 15h8" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/>
            </svg>
            All chapters
        </a>

        <div class="chapter-nav__steps">
            {{-- Previous chapter --}}
            @if(!empty($prevUrl))
                <a href="{{ $prevUrl }}" class="chapter-nav__btn chapter-nav__btn--prev">
                    <span class="chapter-nav__arrow" aria-hidden="true">←</span>
                    <span class="chapter-nav__meta">
                        <span class="chapter-nav__num">{{ $prevNum }}</span>
                        <span class="chapter-nav__label">{{ $prevLabel }}</span>
                    </span>
                </a>
            @else
                <span class="chapter-nav__btn chapter-nav__btn--disabled" aria-hidden="true"></span>
            @endif

            {{-- Next chapter --}}
            <a href="{{ $nextUrl }}" class="chapter-nav__btn chapter-nav__btn--next">
                <span class="chapter-nav__meta">
                    <span class="chapter-nav__num">{{ $nextNum }}</span>
                    <span class="chapter-nav__label">{{ $nextLabel }}</span>
                </span>
                <span class="chapter-nav__arrow" aria-hidden="true">→</span>
            </a>
        </div>

    </div>
</nav>
