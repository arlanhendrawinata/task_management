@component('mail::message')
# Email Attach

Click to Verify

@component('mail::button', ['url' => ''])
Verify
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
