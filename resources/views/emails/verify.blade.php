@component('mail::message')
# ¡Hola {{ $user->name }}!

¡Gracias por registrarte en El Dorado!  
Haz clic en el botón de abajo para verificar tu dirección de correo electrónico.

@component('mail::button', ['url' => $url])
Verificar correo
@endcomponent

Si no creaste esta cuenta, no es necesario hacer nada.

Gracias,<br>
Equipo de El Dorado

@endcomponent
