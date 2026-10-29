@php $partners = trans('home.partners.items'); @endphp
<section class="section partners" id="partners" data-sky="noon" data-spine-label="{{ __('home.partners.eyebrow') }}" aria-labelledby="partners-title">
    <div class="container">
        <header class="section-head section-head--split">
            <div>
                <p class="eyebrow">{{ __('home.partners.eyebrow') }}</p>
                <h2 id="partners-title" class="h2" data-split>{{ __('home.partners.title') }}</h2>
            </div>
            <p class="lead">{{ __('home.partners.lede') }}</p>
        </header>
    </div>

    {{-- The track holds the list twice so the loop seams invisibly; the copy is hidden from assistive tech. --}}
    <div class="partners__marquee">
        <div class="partners__track">
            @foreach ([false, true] as $copy)
                <ul class="partners__list" @if ($copy) aria-hidden="true" @else aria-label="{{ __('home.partners.list_label') }}" @endif>
                    @foreach ($partners as $partner)
                        <li class="partners__item">
                            <img src="{{ asset('images/partners/'.$partner['logo']) }}" alt="{{ $copy ? '' : $partner['name'] }}" loading="lazy" decoding="async">
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</section>
