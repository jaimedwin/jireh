<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Cambio en las actuaciones registradas</title>
</head>

<body>
    <p>Hola!,</p>
    <br>
    <p>Se ha noticado de un cambio en las actuaciones registradas al proceso número {{$proceso_numero}}. Siga las instrucciones a continuación.</p>
    <ol>
        <li>
            <p>Haga clic en el siguiente enlace para ingresar al sistema de consulta.</p>
            <p><a href="{{$url}}">{{$url}}</a></p>
            <p>Si al hacer clic en el enlace no funciona, puede copiar el enlace en la ventana de su navegador o
                escribirlo directamente allí.</p>
        </li>
        <li>
            <p>Ingrese la siguiente información en el formulario de consulta</p>
            <ul>
                <li>Código del cliente: {{$personanatural_codigo}}</li>
                <li>Código del proceso: {{$proceso_codigo}}</li>
                <li>Contraseña: {{date('dmY', strtotime($personanatural_fechaexpedicion))}}</li>
            </ul>
        </li>
    </ol>
    <br>
    <p>Saludos,</p>
    <p>Tu equipo JIREH SOLUCIONES JURIDICAS S.A.S</p>
</body>

</html>