<x-mail::message>
# {{ __('contact.result.success_title') }}

{{ __('contact.mail.confirmation_intro') }}

<x-mail::panel>
**{{ $inquiry->reference }}** · {{ $inquiry->interestLabel() }}<br>
{{ $inquiry->subject }}

{{ $inquiry->message }}
</x-mail::panel>

{{ config('lifopu.company.name') }} — {{ config('lifopu.company.tagline') }}
</x-mail::message>
