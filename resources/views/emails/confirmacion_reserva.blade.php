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

    </style>
</head>

<body>
    <div class="margened">
        <h3>Hola!
            <strong>{{ $paciente->nombre_paciente }}&nbsp;{{ $paciente->ap_pat_paciente }}&nbsp;{{ $paciente->ap_mat_paciente }}</strong>
        </h3>
    </div>

    <div class="margened text-just">
        <h4>Hemos registrado con éxito tu cita con psicológo
            {{ $psicologo->nombre_usuario }}&nbsp;{{ $psicologo->apellido_pat_usuario }}&nbsp;para el día
            {{ \Carbon\Carbon::parse($reserva->fecha_hora_reserva)->format('d-m-Y') }}&nbsp; a las
            {{ \Carbon\Carbon::parse($reserva->fecha_hora_reserva)->format('H:i') }}&nbsp;horas, el día antes de la cita
            te haremos llegar un correo con el link de la reunión, la cual se realizará via zoom.</h4>
    </div>

    <div class="margened text-just">
        <p>Para cualquier información puedes contactarnos a contacto@espaciocrecer.cl</p>
        <p>Siguenos en nuestro instagram <a href="https://www.instagram.com/espaciocrecer_/" target="_blank">@espaciocrecer</a> para
            conocernos más</p>
        <p>Este mail fue enviado por Espacio Crecer</p>
        <a href="http://localhost:8000">www.espaciocrecer.cl</a>
    </div>

</body>

</html>
