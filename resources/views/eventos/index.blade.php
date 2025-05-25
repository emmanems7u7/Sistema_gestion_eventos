@extends('layouts.argon')

@section('content')

    <div class="card card-frame card-profile-bottom">
        <div class="card-body">
            <h3>Eventos</h3>
            <div class="row">
                <div class="col">
                    Acciones
                </div>

            </div>

            <div class="row mt-3">
                <div class="col">
                    <div class="col">


                    </div>
                </div>
                <div class="col">
                    <form method="GET" action="{{ route('eventos.index') }}" class="d-flex mb-3">
                        <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar"
                            value="{{ request('buscar') }}">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
                    </form>
                </div>

            </div>

            <div class="row">
                <div class="col">

                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="calendarioModal" tabindex="-1" aria-labelledby="calendarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarioModalLabel">Calendario de Eventos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div id="calendar"></div>
                </div>
                <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cerrar</button></div>
            </div>
        </div>
    </div>



    @if($eventos->isNotEmpty())
        <div class="card card-frame card-profile-bottom">
            <div class="card-body">
                <p>Filtrar por:</p>
                <div class="row justify-content-center d-flex mb-3">

                    <div class="col-md-3">
                        <form method="GET" action="{{ route('eventos.index') }}">
                            <input type="hidden" name="estado_aprobacion" value="2">
                            <button type="submit" class="btn btn-sm btn-success w-100">
                                Aprobado Automático
                            </button>
                        </form>
                    </div>


                    <div class="col-md-2">
                        <form method="GET" action="{{ route('eventos.index') }}">
                            <button type="submit" class="btn btn-sm btn-secondary w-100">
                                Ver Todos
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-frame card-profile-bottom">
            <div class="card-body">
                <div class="responsive">

                    <table class="table table-bordered table-striped mt-4">
                        <thead class="table-dark">
                            <tr class="bg-dark">
                                <td colspan="7" class="text-end"> <!-- Asegúrate de que ocupe todo el ancho disponible -->
                                    <span type="button" class="text-white" data-bs-toggle="modal"
                                        data-bs-target="#calendarioModal">
                                        Ver Calendario <i class="fas fa-calendar" style="margin-left: 5px;"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Evento</th>
                                <th>Fecha de registro</th>
                                <th>Fecha Evento</th>
                                <th>Hora Inicio</th>
                                <th>Hora Fin</th>

                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventos as $evento)
                                <tr>
                                    <td>{{ $evento->titulo }}</td>

                                    <td>{{ \Carbon\Carbon::parse($evento->created_at)->format('d/m/Y H:i') }}</td>
                                    @php


                                        $fechaEvento = \Carbon\Carbon::parse($evento->fecha)->toDateString(); // yyyy-mm-dd
                                        $fechaHoy = \Carbon\Carbon::today()->toDateString();
                                        $clase = $fechaEvento === $fechaHoy ? 'table-warning' : '';
                                    @endphp

                                    <td class="{{ $clase }}">{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</td>

                                    <td>{{ $evento->hora_inicio }}</td>
                                    <td>{{ $evento->hora_fin }}</td>


                                    <td class="text-center">

                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-check-circle"></i> Detalle
                                        </button>

                                        <a href="{{ route('eventos.edit', $evento) }}" class="btn btn-sm btn-primary me-1">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>

                                        <form action="{{ route('eventos.destroy', $evento) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $eventos->links('pagination::bootstrap-4') }}
                    </div>

                </div>


            </div>
        </div>
    @else
        <div class="col-12 mt-3">
            <div class="alert alert-warning text-center">No Eventos.</div>
        </div>
    @endif
    <script>
        let calendarInstance;

        const renderCalendar = () => {
            const calendarEl = document.getElementById('calendar');

            if (calendarInstance) {
                calendarInstance.destroy(); // Evita duplicados
            }

            calendarInstance = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Cambié a la vista de mes por defecto
                headerToolbar: {
                    left: 'prev,next today',  // Botones de navegación
                    center: 'title',          // Título en el centro
                    right: 'dayGridMonth,timeGridWeek,timeGridDay' // Opciones de vistas
                },
                views: {
                    dayGridMonth: { buttonText: 'Mes' },
                    timeGridWeek: { buttonText: 'Semana' },
                    timeGridDay: { buttonText: 'Día' }
                },
                locale: 'es', // Establece el idioma a español
                events: @json($eventos->map(fn($e) => [
                    'title' => $e->titulo,
                    'start' => $e->fecha,
                ]))
            });

            calendarInstance.render();
        };

        const modal = document.getElementById('calendarioModal');
        modal.addEventListener('shown.bs.modal', renderCalendar);
    </script>

    <style>
        #calendar {
            width: 100%;
            height: 500px;
            /* Altura predeterminada */
        }

        /* Responsividad del calendario */
        @media (max-width: 768px) {
            #calendar {
                height: 400px;
                /* Ajusta la altura para pantallas pequeñas */
            }
        }

        .modal-dialog {
            max-width: 100%;
            /* El modal ocupa el 100% en pantallas pequeñas */
        }
    </style>
@endsection