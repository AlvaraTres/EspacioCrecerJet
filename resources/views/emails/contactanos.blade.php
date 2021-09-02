<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h3 {
            color: rgb(5, 150, 105);
            text-align: center;
        }

        body {
            background-image: url('{{ asset('images/logo_opacidad_40.png') }}');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: 50% 50%;
        }

        .margened{
            margin-left: 5%;
            margin-right: 5%;
        }

        .text-just{
            text-align: justify;
            text-justify: inter-word;
        }
        .text-cent{
            text-align: center;
        }
        .borderers{
            position: relative;
            border: 2px solid #10b981;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="margened">
        <h3>Hola!, ha llegado un mensaje de <strong>{{ $person }}&nbsp; indicando lo siguiente:
        </h3>
        <br>
    </div>

    <div class="margened text-cent borderers">
        <p>{!! $mensaje !!}</p>
    </div>
    <br>
    <div class="margened text-just">
        <p>Datos de contacto que dejó la persona:</p>
        <p>nombre: {{$person}}</p>
        <p>Email: {{$mail}}</p>
        <p>Teléfono: {{$phone}}</p>
        <p>Este mail fue enviado desde el módulo Contactanos de Espacio Crecer</p>
        <a href="http://localhost:8000">www.espaciocrecer.cl</a>
    </div>
</body>
</html>