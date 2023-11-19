<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('general.Password Reset')}}</title>
</head>
<body>
<h2>{{__('general.Password Reset')}}</h2>

<p>{{__('general.Hello')}},</p>

<p>{{__('general.You are receiving this email because we received a password reset request for your account')}}</p>
<p>
    {{__('general.If you requested a password reset, please click the following link to reset your password')}}:
    <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
</p>
<p>{{__('general.If you did not request a password reset, no further action is required')}}</p>

<p>{{__('general.Regards')}},</p>
<p>{{env('APP_NAME', 'Moemen Gaballa')}}</p>
</body>
</html>
