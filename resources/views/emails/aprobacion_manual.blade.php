<!DOCTYPE html>
<html>

<head>
    <title>Notificación de Aprobación Manual</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 40px 0;
            color: #333333;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px 40px;
        }

        h1 {
            color: #1a1a1a;
            font-weight: 700;
            font-size: 26px;
            margin-bottom: 20px;
        }

        p {
            font-size: 15px;
            line-height: 1.5;
            margin-bottom: 25px;
        }

        a.button {
            background-color: #007bff;
            color: #fff !important;
            padding: 12px 24px;
            text-decoration: none;
            font-weight: 600;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: #0056b3;
        }

        .footer {
            font-size: 12px;
            color: #888888;
            text-align: center;
            margin-top: 35px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Aprobación Manual de Solicitud</h1>
        <p>Estimado equipo,</p>
        <p>Se ha registrado una aprobación Manual para la siguiente solicitud.</p>
        <p>Por favor, revise los detalles haciendo clic en el siguiente enlace:</p>
        <a href="{{ route('solicitud.aprobar', $solicitud) }}" class="button" target="_blank"
            rel="noopener noreferrer">Ver Solicitud</a>
        <p>Para cualquier consulta, por favor contacte con el área correspondiente.</p>
        <p>Saludos,<br>Departamento de Administración</p>
    </div>
    <div class="footer">
        <p>Este email fue enviado Automaticamente por <strong>{{ env('APP_NAME') }}</strong>.</p>
        <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. Todos los derechos reservados.</p>
    </div>
</body>

</html>