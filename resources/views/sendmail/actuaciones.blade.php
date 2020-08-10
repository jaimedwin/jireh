<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Cambio en las actuaciones registradas</title>
</head>

<body>
    <p>Señor (a) </p> 
    <p>{{$personanatural_nombrecompleto}}</p>
    <br>
    <p>Cordial saludo</p>
    <p>Con la presente queremos informarle que su proceso número {{$proceso_numero}}, ha tenido un cambio en la actuación, el cual podrá consultarlo siguiendo las siguientes instrucciones.</p>
    <br>
    <ol>
        <li>
            <p>Haga clic en el siguiente enlace para ingresar al sistema de consulta.</p>
            <p><a href="{{$url}}">{{$url}}</a></p>
            <p>Si al hacer clic en el enlace no funciona, puede copiar el enlace en la ventana de su navegador o escribirlo directamente allí.</p>
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
    <p>Tu equipo SOLUCIONES JURIDICAS JIREH S.A.S</p>
    <p>Este correo es de tipo informativo y por lo tanto, le pedimos no responda a este mensaje. Si desea enviarnos sus comentarios acerca de nuestro servicio visite nuestra página web en la sección de canales de servicio o escribanos al correo electrónico contacto@juridicasjireh.com.co.</p>
    <p>Aviso legal: El contenido de este mensaje y los archivos adjuntos son confidenciales y de uso exclusivo de SOLUCIONES JURIDICAS JIREH S.A.S. Si lo ha recibido por error, infórmenoslo y elimínelo de su correo. Las opciones, información, conclusiones y cualquier otro tipo de datos contenido en este correo electrónico, no relacionados con la actividad de SOLUCIONES JURIDICAS JIREH S.A.S. se entenderán como personales y de ninguna manera son avaladas por SOLUCIONES JURIDICAS JIREH S.A.S. Se encuentran dirigidos solo al uso del destinatario al cual van enviados. La reproducción, lectura y/o copia se encuentra prohibidas a cualquier persona diferente a éste y puede ser ilegal.</p>

</body>

</html>