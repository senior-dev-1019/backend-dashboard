@component('mail::message')
# Dear **{{$data->name}}**,

Welcome to @lang('dashboard.app-name'), you have been registered to the website.
You could login to the website with:
Email: {{$data->email}}
Password: {{$data->password}}


Thank you,<br>

{{ config('app.name') }}

@endcomponent
