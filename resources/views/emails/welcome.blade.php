@component('mail::message')
# Hello {{ $user->name }}

Welcome to our Paints Website! We're excited to have you on board.

@component('mail::button', ['url' => url('/')])
Visit Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
