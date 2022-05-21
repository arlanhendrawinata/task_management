@component('mail::message')
# Verify Account

Silahkan tekan tombol dibawah untuk mengaktifkan account

@component('mail::button', ['url' => '/'])
Click to Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
