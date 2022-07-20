@component('mail::message')
# Introducao

Coloque o corpo do email aqui!

@component('mail::button', ['url' => ''])
Texto do botao
@endcomponent

@component('mail::button', ['url' => ''])
Texto do botao 2 teste
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
