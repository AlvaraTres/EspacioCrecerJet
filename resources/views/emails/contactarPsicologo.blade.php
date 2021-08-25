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
        .borderers{
            position: relative;
            border: 2px solid #10b981;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="margened">
        <h3>Hola!
            <strong>{{$psicologo->nombre_usuario}}&nbsp;{{$psicologo->apellido_pat_usuario}}&nbsp;</strong>,
            la administración de Espacio Crecer te ha enviado el siguiente mensaje:
        </h3>
        <br>
    </div>

    <div class="margened text-just borderers">
        <p>{{$cuerpo}}</p>
    </div>

    <div class="margened text-just">
        <p>Este mail fue enviado por Espacio Crecer</p>
        <a href="http://localhost:8000">www.espaciocrecer.cl</a>
    </div>
</body>
</html>