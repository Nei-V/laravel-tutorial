@component('mail::message')
# Welcome to Instagram Clone made by Ion Varsescu

This is a clone made following a Laravel tutorial on freeCodeCamp Youtube Channel

@component('mail::button', ['url' => 'https://ionvarsescu.tk'])
Visit my site
@endcomponent



All the best,<br>{{-- 
{{ config('app.name') }} --}}
Ion Varsescu
@endcomponent
