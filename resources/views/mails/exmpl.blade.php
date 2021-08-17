@component('mail::message')
Hola **{{$name}}**,  {{-- use double space for line break --}}
Bienvenido a la aplicación de estudiantes.

Clic en el siguiente enlace para ingresar.
@component('mail::button', ['url' => $link])
Ingresa
@endcomponent
Atentamente,
Julio Salguero.
@endcomponent