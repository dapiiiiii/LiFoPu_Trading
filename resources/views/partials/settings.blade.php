<div class="settings" id="settings" role="dialog" aria-labelledby="settings-title" data-settings hidden>
    <h2 id="settings-title" class="settings__title">{{ __('common.settings.title') }}</h2>

    <fieldset class="settings__group">
        <legend>{{ __('common.settings.quality') }}</legend>
        @foreach (__('common.settings.tiers') as $tier => $copy)
            <label class="settings__tier">
                <input type="radio" name="lf-quality" value="{{ $tier }}" data-quality-option>
                <span class="settings__tier-label">{{ $copy['label'] }}</span>
                <span class="settings__tier-hint">{{ $copy['hint'] }}</span>
            </label>
        @endforeach
    </fieldset>

    <div class="settings__row">
        <span id="settings-sound">{{ __('common.settings.sound') }}</span>
        <button type="button" class="switch" role="switch" aria-checked="false" aria-labelledby="settings-sound" data-sound-toggle>
            <span class="switch__thumb"></span>
        </button>
    </div>

    <div class="settings__group">
        <p class="settings__legend">{{ __('common.settings.language') }}</p>
        <ul class="settings__langs">
            @foreach (config('lifopu.locales') as $code => $locale)
                <li>
                    @if ($locale['ready'])
                        <a href="{{ route('locale', $code) }}" @if (app()->getLocale() === $code) aria-current="true" @endif>{{ $locale['native'] }}</a>
                    @else
                        <span class="settings__lang--soon" lang="{{ $code }}" aria-describedby="settings-am-note">
                            {{ $locale['native'] }} <small>{{ __('common.settings.coming_soon') }}</small>
                        </span>
                    @endif
                </li>
            @endforeach
        </ul>
        <p class="settings__note" id="settings-am-note">{{ __('common.settings.am_note') }}</p>
    </div>
</div>
