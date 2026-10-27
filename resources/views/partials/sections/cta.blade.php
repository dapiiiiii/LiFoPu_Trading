@php $contact = config('lifopu.contact'); @endphp
<section class="cta" data-sky="sunrise" data-spine-label="{{ __('common.nav.contact') }}" data-pattern-zone aria-labelledby="cta-title">
    <x-pattern class="cta__pattern" scale="0.06" interactive />
    <div class="cta__sun" aria-hidden="true"></div>
    <div class="container cta__inner">
        <h2 id="cta-title" class="cta__title" data-split>{{ $title ?? __('home.cta.title') }}</h2>
        <p class="cta__lede">{{ $lede ?? __('home.cta.lede') }}</p>
        <div class="cta__actions">
            <a href="{{ $href ?? route('contact') }}" class="btn btn--light btn--lg">{{ $label ?? __('common.actions.contact_team') }} <span aria-hidden="true">→</span></a>
            <a href="tel:{{ $contact['phone_href'] }}" class="btn btn--ghost-light btn--lg">{{ __('common.actions.call') }} {{ $contact['phone'] }}</a>
        </div>
    </div>
</section>
