<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <style>
        body {
            background-image: url(<?php echo $pic; ?>) center center no-repeat;
            background-repeat: no-repeat;
            padding: 300px 100px 10px 100px;
            height: 100%;
            width: 100%;
            background-size: 100%;
        }
        .center-title{
            background-color: #5bc0de;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            border-radius: 6px;
        }
        .borde-info{
            border: 1px solid black;
        }
        .borde-info-sin-arriba{
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
        }
        .borde-info-sin-abajo{
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-top: 1px solid black;
        }
        .borde-info-sin-izq{
            border-top: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
        }
        .borde-info-sin-der{
            border-left: 1px solid black;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
        .borde-info-sin-izq-sin-arriba{
            border-right: 1px solid black;
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="contenedor" style="margin-top: -35%;">
        <div class="center-title">
            <p class="text-center" style="padding-top: 2px; margin-top: 2px;"><strong>FICHA PACIENTE</strong></p>
        </div>
        <br>
        <div class="container" style="margin-top: 5%;">
            @foreach ($datos_ficha as $datos)
                <div class="row">
                    <div class="col-xs-12 bg-primary" style="border-radius: 6px;">Fecha de atención: {{ $datos->fecha_atencion_ficha }}</div>
                </div>
                <div class="row">
                    <div class="col"><br></div>
                </div>
                <div class="row">
                    <div class="col-xs-2 borde-info align-right"><dt>Nombre:</dt></div>
                    <div class="col-xs borde-info-sin-izq">{{$datos->nombre_paciente}}</div>
                </div>
                <div class="row">
                    <div class="col-xs-2 borde-info-sin-arriba align-right"><dt>Apellidos:</dt></div>
                    <div class="col-xs borde-info-sin-izq-sin-arriba">{{$datos->ap_pat_paciente}}&nbsp;{{$datos->ap_mat_paciente}}</div>
                </div>
                <div class="row">
                    <div class="col-xs-2 borde-info-sin-arriba align-right"><dt>Edad:</dt></div>
                    <div class="col-xs-2 borde-info-sin-izq-sin-arriba">{{$edad_calculada}}</div>
                    <div class="col-xs-2 borde-info-sin-izq-sin-arriba"><dt>Sexo:</dt></div>
                    <div class="col-xs borde-info-sin-izq-sin-arriba">Masculino</div>
                </div>
                <div class="row">
                    <div class="col"><br></div>
                </div>
                <div class="row">
                    <div class="col-xs borde-info"><dt>Alergias</dt></div>
                </div>
                <div class="row">
                    <div class="col-xs borde-info-sin-arriba">{{$datos->alergia}}</div>
                </div>
                <div class="row">
                    <div class="col"><br></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 borde-info"><dt>Observaciones</dt></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 borde-info-sin-arriba">
                        <p>{{$datos->resumen_atencion}}</p>
                    </div>
                </div>
                

                
            @endforeach
        </div>
    </div>

</body>

</html>
