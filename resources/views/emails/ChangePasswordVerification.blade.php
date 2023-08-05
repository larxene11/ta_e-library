@component('mail::message')
# Change Password Verification

Hello {{ $user->name }},

We received a request to change your password. Please click the button below to verify your email address and complete the password change process:

@component('mail::button', ['url' => route('password.verify', ['token' => $resetToken])])
Verify Email
@endcomponent

If you did not request to change your password, you can safely ignore this email.

Thanks,
{{ config('app.name') }}
@endcomponent