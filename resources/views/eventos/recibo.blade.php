<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibo de Evento</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
        }

        .ticket-container {
            width: 780px;
            margin: 20px auto;
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border: 1px solid #e5e5e5;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px dashed #ccc;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header small {
            display: block;
            margin-top: 5px;
            color: #777;
        }

        .section {
            margin-top: 20px;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
            text-transform: uppercase;
        }

        .box {
            border: 1px solid #ddd;
            padding: 10px 15px;
            background: #fafafa;
            border-radius: 6px;
        }

        .data-line {
            margin: 3px 0;
        }

        .data-line span {
            font-weight: bold;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 12px;
        }

        table th {
            background: #f0f0f0;
            border-bottom: 1px solid #ccc;
            padding: 6px;
            text-align: left;
            text-transform: uppercase;
            font-size: 12px;
        }

        table td {
            border-bottom: 1px solid #eee;
            padding: 6px;
        }

        .total-box {
            margin-top: 25px;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            background: #e8f5e9;
            border: 1px solid #c8e6c9;
        }

        .total-box h2 {
            margin: 0;
            font-size: 22px;
            color: #2e7d32;
            font-weight: bold;
        }

        .line {
            border-bottom: 2px dashed #ccc;
            margin: 25px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="ticket-container">

        <div class="header">
            <h1>Recibo de Evento: {{ $evento->titulo }}</h1>
            <small>Emitido el {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</small>
        </div>

        <!-- DATOS DEL CLIENTE -->
        <div class="section">
            <div class="section-title">Datos del Cliente</div>
            <div class="box">
                <p class="data-line"><span>Nombre:</span> {{ $cliente->nombre }} {{ $cliente->ape_pat }}
                    {{ $cliente->ape_mat }}</p>
                <p class="data-line"><span>Correo:</span> {{ $cliente->email }}</p>
                <p class="data-line"><span>Teléfono:</span> {{ $cliente->telefono }}</p>
            </div>
        </div>

        <!-- DETALLES DEL EVENTO -->
        <div class="section">
            <div class="section-title">Detalles del Evento</div>
            <div class="box">
                <table>
                    <tr>
                        <td><span>Fecha:</span> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</td>
                        <td><span>Hora Inicio:</span> {{ $evento->hora_inicio }}</td>
                        <td><span>Hora Fin:</span> {{ $evento->hora_fin }}</td>
                    </tr>
                    <tr>
                        <td><span>Ubicación:</span> {{ $evento->ubicacion }}</td>
                        <td colspan="2"><span>Descripción:</span> {{ $evento->descripcion }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- SERVICIOS -->
        @if($tipo_servicios->isNotEmpty())
            <div class="section">
                <div class="section-title">Servicios Solicitados</div>
                <div class="box">
                    <table>
                        <thead>
                            <tr>
                                <th>Servicio</th>
                                <th>Tipo</th>
                                <th>Características</th>
                                <th class="text-right">Precio (Bs/hora)</th>
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
            </div>
        @endif

        <!-- PERSONAL -->
        @if($personal)
            <div class="section">
                <div class="section-title">Personal Asignado</div>
                <div class="box">
                    <table>
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
                                    <td>{{ $usuarios['usuario_telefono'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- TOTAL -->
        <div class="total-box">
            <h2>Total: Bs. {{ number_format($total, 2) }}</h2>
            <small>El monto total se calcula según servicios solicitados y horas de duración.</small>
        </div>

        <div class="footer">
            Gracias por confiar en nuestros servicios.
        </div>
    </div>

</body>

</html>