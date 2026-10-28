<x-mail::message>
# New inquiry {{ $inquiry->reference }}

**{{ $inquiry->interestLabel() }}**: {{ $inquiry->subject }}

<x-mail::table>
| | |
|:--|:--|
| Name | {{ $inquiry->name }} |
| Organization | {{ $inquiry->organization ?: 'Not provided' }} |
| Email | {{ $inquiry->email }} |
| Phone | {{ $inquiry->phone ?: 'Not provided' }} |
@foreach ($inquiry->details ?? [] as $key => $value)
| {{ __("contact.fields.$key") }} | {{ \Illuminate\Support\Facades\Lang::has("contact.options.$key.$value") ? __("contact.options.$key.$value") : $value }} |
@endforeach
| Received | {{ $inquiry->created_at->format('j M Y, H:i') }} |
</x-mail::table>

{{ $inquiry->message }}

Reply to this email to answer {{ $inquiry->name }} directly.
</x-mail::message>
