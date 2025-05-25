<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibo de Evento</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        h1,
        h2,
        h3 {
            margin-bottom: 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .border {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .bold {
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <h1 class="text-center">Recibo de Evento {{ $evento->titulo }}</h1>
    <p class="text-center">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>

    <div class="section border">
        <h3>Datos del Cliente</h3>
        <p><span class="bold">Nombre:</span> {{ $cliente->nombre }} {{ $cliente->ape_pat }} {{ $cliente->ape_mat }}</p>
        <p><span class="bold">Correo:</span> {{ $cliente->email }}</p>
        <p><span class="bold">Teléfono:</span> {{ $cliente->telefono }}</p>
    </div>

    <div class="section border">
        <h3>Detalles del Evento</h3>
        <table class="table" style="width: 100%;">
            <tr>
                <td><span class="bold">Título:</span> {{ $evento->titulo }}</td>
                <td><span class="bold">Fecha:</span> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</td>
                <td><span class="bold">Hora Inicio:</span> {{ $evento->hora_inicio }}</td>
            </tr>
            <tr>
                <td><span class="bold">Hora Fin:</span> {{ $evento->hora_fin }}</td>
                <td><span class="bold">Ubicación:</span> {{ $evento->ubicacion }}</td>
                <td><span class="bold">Descripción:</span> {{ $evento->descripcion }}</td>
            </tr>
        </table>
    </div>


    @if($tipo_servicios->isNotEmpty())
        <div class="section border">
            <h3>Servicios Solicitados</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Tipo</th>
                        <th>Características</th>
                        <th>Precio (Bs/hora)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipo_servicios as $servicio)
                        <tr>
                            <td>{{ $servicio['nombre_servicio'] }}</td>
                            <td>{{ $servicio['nombre_tipo_servicio'] }}</td>
                            <td>{{ $servicio['caracteristicas_tipo_servicio'] }}</td>
                            <td class="text-right">{{ number_format($servicio['precio_tipo_Servicio'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if($personal)
        <div class="section border">
            <h3>Personal Asignado</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Celular</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personal as $usuarios)

                        <tr>
                            <td>{{ $usuarios['roles'] }}</td>
                            <td>{{ $usuarios['usuario_nombres'] }}</td>
                            <td>{{ $usuarios['usuario_app'] }} {{ $usuarios['usuario_apm'] }}</td>
                            <td> {{ $usuarios['usuario_telefono'] }}</td>
                        </tr>


                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="section border text-center">
        <h3 class="text-success">Total del Evento</h3>
        <p class="bold" style="font-size: 16px;">Bs. {{ number_format($total, 2) }}</p>
        <p class="mt-2" style="font-size: 12px;">
            El monto total se calcula en base a los servicios solicitados, considerando su tarifa por hora y la duración
            total del evento.
        </p>
    </div>

</body>

</html>