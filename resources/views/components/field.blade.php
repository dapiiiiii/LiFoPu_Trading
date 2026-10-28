@props([
    'name',
    'label',
    'type' => 'text',
    'hint' => null,
    'required' => false,
    'options' => null,
    'for' => null,
    'value' => null,
    'autocomplete' => null,
    'detail' => false,
])
@php
    $key = $detail ? "details.$name" : $name;
    $inputName = $detail ? "details[$name]" : $name;
    $id = 'f-'.$name;
    $error = $errors->first($key);
    $describedBy = trim(($hint ? "$id-hint " : '').($error ? "$id-error" : '')) ?: null;
    $current = old($key, $value);
@endphp
<div {{ $attributes->merge(['class' => 'field'.($error ? ' field--invalid' : '')]) }} @if ($for) data-for="{{ $for }}" @endif data-field="{{ $key }}">
    <label class="field__label" for="{{ $id }}">
        {{ $label }}
        @if ($required)<span class="field__req" aria-hidden="true">*</span>@endif
    </label>
    @if ($options)
        <select class="field__control" id="{{ $id }}" name="{{ $inputName }}" @required($required) @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif @if ($error) aria-invalid="true" @endif>
            <option value="">{{ __('common.select') }}</option>
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected($current === $optionValue)>{{ $optionLabel }}</option>
            @endforeach
        </select>
    @elseif ($type === 'textarea')
        <textarea class="field__control" id="{{ $id }}" name="{{ $inputName }}" rows="5" @required($required) @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif @if ($error) aria-invalid="true" @endif>{{ $current }}</textarea>
    @else
        <input class="field__control" id="{{ $id }}" name="{{ $inputName }}" type="{{ $type }}" value="{{ $current }}" @required($required) @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif @if ($error) aria-invalid="true" @endif>
    @endif
    @if ($hint)
        <p class="field__hint" id="{{ $id }}-hint">{{ $hint }}</p>
    @endif
    <p class="field__error" id="{{ $id }}-error" @if (! $error) hidden @endif>{{ $error }}</p>
</div>
