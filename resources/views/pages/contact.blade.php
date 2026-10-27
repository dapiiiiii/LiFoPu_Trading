@php
    $contact = config('lifopu.contact');
    $f = trans('contact.fields');
    $o = trans('contact.options');
    $s = trans('contact.steps');
    $result = session('inquiry');
    $icons = ['fuel' => 'station', 'lubricants' => 'oil', 'transport' => 'tanker', 'coffee' => 'coffee'];
@endphp
<x-layout :title="__('contact.meta_title')" :description="__('contact.meta_description')" page="contact">

    <x-page-hero :eyebrow="__('contact.eyebrow')" :title="__('contact.title')" :lede="__('contact.lede')" scene="road-end" class="page-hero--compact" />

    <section class="section contact" data-sky="morning" data-spine-label="{{ $s['need'] }}" aria-label="{{ __('contact.eyebrow') }}">
        <div class="container contact__grid">
            <div class="inquiry" data-inquiry data-subjects='@json(trans('contact.subjects'))'>
                <div class="inquiry__result @if ($result) inquiry__result--{{ $result['ok'] ? 'success' : 'error' }} @endif" data-inquiry-result tabindex="-1" @if (! $result) hidden @endif role="{{ ($result['ok'] ?? true) ? 'status' : 'alert' }}">
                    <h2 class="inquiry__result-title" data-result-title>{{ $result ? __($result['ok'] ? 'contact.result.success_title' : 'contact.result.error_title') : '' }}</h2>
                    <p data-result-message>{{ $result['message'] ?? '' }}</p>
                    <button type="button" class="btn btn--ghost btn--sm" data-inquiry-reset @if (! ($result['ok'] ?? false)) hidden @endif>{{ __('contact.result.another') }}</button>
                </div>

                <form method="POST" action="{{ route('contact.store') }}" class="inquiry__form" data-inquiry-form novalidate @if ($result['ok'] ?? false) hidden @endif
                      data-msg-success="{{ __('contact.result.success_title') }}" data-msg-error-title="{{ __('contact.result.error_title') }}"
                      data-msg-error="{{ __('contact.result.error') }}" data-msg-throttled="{{ __('contact.result.throttled') }}"
                      data-msg-validation="{{ __('contact.result.validation') }}" data-msg-sending="{{ $s['sending'] }}"
                      data-msg-progress="{{ $s['progress'] }}">
                    @csrf
                    <input type="hidden" name="_started" value="{{ $started }}">
                    <div class="hp" aria-hidden="true">
                        <label for="f-website">{{ $f['website'] }}</label>
                        <input type="text" id="f-website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="inquiry__alert" role="alert" data-inquiry-alert @if (! $errors->any()) hidden @endif>
                        @if ($errors->any())
                            <p>{{ __('contact.result.validation') }}</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <ol class="inquiry__progress" aria-hidden="true" data-inquiry-progress>
                        <li data-active>{{ $s['need'] }}</li>
                        <li>{{ $s['details'] }}</li>
                        <li>{{ $s['you'] }}</li>
                    </ol>
                    <p class="sr-only" aria-live="polite" data-step-status></p>

                    {{-- Step 1 --}}
                    <fieldset class="inquiry__step" data-step="1">
                        <legend class="inquiry__legend">{{ $s['need'] }}</legend>
                        <div class="choice-grid">
                            @foreach (trans('contact.interests') as $key => $interest)
                                <label class="choice">
                                    <input type="radio" name="interest" value="{{ $key }}" required @checked(old('interest', $preset) === $key)>
                                    <span class="choice__body">
                                        <span class="choice__icon" aria-hidden="true">
                                            @isset($icons[$key])
                                                @include('partials.scenes.thumb', ['scene' => $icons[$key]])
                                            @else
                                                <svg viewBox="0 0 {{ $key === 'partnership' ? '1400 1400' : '661.1 572.4' }}"><use href="#{{ $key === 'partnership' ? 'lf-motif-pairs' : 'lf-mark' }}" /></svg>
                                            @endisset
                                        </span>
                                        <span class="choice__label">{{ $interest['label'] }}</span>
                                        <span class="choice__hint">{{ $interest['hint'] }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        <p class="field__error" id="f-interest-error" data-field-error="interest" @if (! $errors->has('interest')) hidden @endif>{{ $errors->first('interest') }}</p>
                        <div class="inquiry__nav">
                            <button type="button" class="btn btn--primary" data-step-next>{{ $s['next'] }} <span aria-hidden="true">→</span></button>
                        </div>
                    </fieldset>

                    {{-- Step 2 --}}
                    <fieldset class="inquiry__step" data-step="2">
                        <legend class="inquiry__legend">{{ $s['details'] }}</legend>
                        <div class="field-grid">
                            <x-field name="customer_type" :label="$f['customer_type']" :options="$o['customer_type']" for="fuel lubricants" detail class="field--wide" />
                            <x-field name="volume" :label="$f['volume']" :hint="$f['volume_hint']" for="fuel lubricants transport coffee" detail />
                            <x-field name="location" :label="$f['location']" for="fuel lubricants" detail />
                            <x-field name="origin" :label="$f['origin']" for="transport" detail />
                            <x-field name="destination" :label="$f['destination']" for="transport" detail />
                            <x-field name="schedule" :label="$f['schedule']" for="transport" detail />
                            <x-field name="grade" :label="$f['grade']" :options="$o['grade']" for="coffee" detail />
                            <x-field name="market" :label="$f['market']" for="coffee" detail />
                            <x-field name="partner_type" :label="$f['partner_type']" :options="$o['partner_type']" for="partnership" detail />
                            <x-field name="subject" :label="$f['subject']" required class="field--wide" />
                            <x-field name="message" :label="$f['message']" type="textarea" required class="field--wide" />
                        </div>
                        <div class="inquiry__nav">
                            <button type="button" class="btn btn--ghost" data-step-back>{{ $s['back'] }}</button>
                            <button type="button" class="btn btn--primary" data-step-next>{{ $s['next'] }} <span aria-hidden="true">→</span></button>
                        </div>
                    </fieldset>

                    {{-- Step 3 --}}
                    <fieldset class="inquiry__step" data-step="3">
                        <legend class="inquiry__legend">{{ $s['you'] }}</legend>
                        <div class="field-grid">
                            <x-field name="name" :label="$f['name']" required autocomplete="name" />
                            <x-field name="organization" :label="$f['organization']" :hint="$f['organization_hint']" autocomplete="organization" />
                            <x-field name="email" :label="$f['email']" type="email" required autocomplete="email" />
                            <x-field name="phone" :label="$f['phone']" type="tel" :hint="$f['phone_hint']" autocomplete="tel" />
                        </div>
                        <div class="field field--check {{ $errors->has('privacy') ? 'field--invalid' : '' }}" data-field="privacy">
                            <input type="checkbox" id="f-privacy" name="privacy" value="1" required @checked(old('privacy')) aria-describedby="f-privacy-error">
                            <label for="f-privacy">{!! __('contact.fields.privacy', ['link' => '<a href="'.route('privacy').'" target="_blank">'.e($f['privacy_link']).'</a>']) !!}</label>
                            <p class="field__error" id="f-privacy-error" @if (! $errors->has('privacy')) hidden @endif>{{ $errors->first('privacy') }}</p>
                        </div>
                        @if ($turnstileKey)
                            <div class="cf-turnstile" data-sitekey="{{ $turnstileKey }}" data-theme="light"></div>
                            @push('head')<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>@endpush
                        @endif
                        <p class="field__error" data-field-error="_started" @if (! $errors->has('_started')) hidden @endif>{{ $errors->first('_started') }}</p>
                        <div class="inquiry__nav">
                            <button type="button" class="btn btn--ghost" data-step-back>{{ $s['back'] }}</button>
                            <button type="submit" class="btn btn--primary" data-inquiry-submit>{{ $s['submit'] }} <span aria-hidden="true">→</span></button>
                        </div>
                    </fieldset>
                </form>
            </div>

            <aside class="contact-card" aria-labelledby="direct-title">
                <x-pattern class="contact-card__pattern" scale="0.035" />
                <h2 id="direct-title" class="contact-card__title">{{ __('contact.direct.title') }}</h2>
                <dl class="contact-card__list">
                    <div><dt>{{ __('contact.direct.person') }}</dt><dd>{{ $contact['person'] }}</dd></div>
                    <div><dt>{{ __('contact.direct.phone') }}</dt><dd><a href="tel:{{ $contact['phone_href'] }}">{{ $contact['phone'] }}</a></dd></div>
                    <div><dt>{{ __('contact.direct.email') }}</dt><dd><a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a></dd></div>
                </dl>
                <x-logo variant="stacked" title="" class="contact-card__logo" />
            </aside>
        </div>
    </section>

</x-layout>
