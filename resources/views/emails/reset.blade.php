@component('mail::message')
# Introduction
This is verification email. Please click on the button below.

@component('mail::button', ['url' => route("password.confirm").'?token='.$comfirmation_token.'&user_email='.$user_email])
    Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
