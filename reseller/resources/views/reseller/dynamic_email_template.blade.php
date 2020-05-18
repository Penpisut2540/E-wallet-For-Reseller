@component('mail::message')
{{-- Intro Lines --}}
<h1>Hello,</h1>
<p>Form : คุณ {{ $data['name'] }}</p>
<br>
<p> {{ $data['message'] }}</p>
<br>

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Regards'),<br>
{{ $data['name'] }}
@endif
@endcomponent
