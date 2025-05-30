@extends('layouts.argon')

@section('content')
    @if($tiempo_cambio_contraseña != 1)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="container-fluid py-4">

            <div class="container my-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">⚡ Administracion y Acciones rápidas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row my-4 g-4">
                                    <div class="col-6">
                                        <div
                                            class="d-flex align-items-center justify-content-between bg-light p-3 rounded shadow-sm h-100">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3 text-primary">
                                                    <i class="fas fa-calendar-alt fa-2x"></i>
                                                </div>
                                                <div class="fw-semibold">Total Eventos</div>
                                            </div>
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                {{ $total_eventos }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="d-flex align-items-center justify-content-between bg-light p-3 rounded shadow-sm h-100">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3 text-success">
                                                    <i class="fas fa-calendar-plus fa-2x"></i>
                                                </div>
                                                <div class="fw-semibold">Solicitudes de Eventos</div>
                                            </div>
                                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                {{ $total_sol_eventos }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div
                                            class="d-flex align-items-center justify-content-between bg-light p-3 rounded shadow-sm h-100">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3 text-info">
                                                    <i class="fas fa-users fa-2x"></i>
                                                </div>
                                                <div class="fw-semibold">Usuarios</div>
                                            </div>
                                            <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                {{ $usuarios }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row g-3">

                                    @can('usuarios.crear')
                                        <div class="col-md-6">
                                            <a href="{{ route('users.create') }}"
                                                class="btn btn-primary d-flex flex-column align-items-center justify-content-center text-white p-3 rounded-2 w-100"
                                                style="height: 120px;">
                                                <i class="fas fa-user-plus fa-2x mb-2"></i>
                                                <span class="text-center small">Crear<br>Usuarios</span>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('solicitudes.crear')
                                        <div class="col-md-6">
                                            <a href="{{ route('solicitudes.create') }}"
                                                class="btn btn-success d-flex flex-column align-items-center justify-content-center text-white p-3 rounded-2 w-100"
                                                style="height: 120px;">
                                                <i class="fas fa-calendar-plus fa-2x mb-2"></i>
                                                <span class="text-center small">Crear<br>Solicitud</span>
                                            </a>
                                        </div>
                                    @endcan
                                    <div class="col-md-6">
                                        <a href="{{ route('eventos.index') }}"
                                            class="btn d-flex flex-column align-items-center justify-content-center text-white p-3 rounded-2 w-100"
                                            style="background-color: #6f42c1; height: 120px;">
                                            <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                            <span class="text-center small">Ver<br>Eventos</span>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('inventarios.index') }}"
                                            class="btn d-flex flex-column align-items-center justify-content-center text-white p-3 rounded-2 w-100"
                                            style="background-color: #6f42c1; height: 120px;">
                                            <i class="fas fa-boxes fa-2x mb-2"></i>
                                            <span class="text-center small">Ver<br>Inventario</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card my-4">
                    <div class="card-header">
                        <h5 class="mb-0">📊 Eventos por fecha</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="eventosChart" height="120"></canvas>
                    </div>
                </div>


                <div class="card my-4">
                    <div class="card-header">
                        <h5>📊 Solicitudes por fecha</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="solicitudesChart" height="150"></canvas>
                    </div>
                </div>

            </div>

        </div>
        <script>
            const ctx = document.getElementById('eventosChart').getContext('2d');
            const eventosChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($fechas),
                    datasets: [{
                        label: 'Cantidad de eventos',
                        data: @json($totales),
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });


            new Chart(document.getElementById('solicitudesChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: @json($fechasSolicitudes),
                    datasets: [{
                        label: 'Cantidad de solicitudes',
                        data: @json($totalesSolicitudes),
                        fill: true,
                        backgroundColor: 'rgba(75, 192, 192, 0.3)', // relleno suave
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        tension: 0.3, // curva suave
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 } }
                    }
                }
            });
        </script>
    @else

        <div class="alert alert-warning" role="alert">
            <strong>!Alerta!</strong> Debes actualizar tu contraseña
        </div>

    @endif
@endsection