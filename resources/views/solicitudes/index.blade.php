@extends('layouts.argon')

@section('content')

    <div class="card card-frame card-profile-bottom">
        <div class="card-body">
            <h3>Solicitudes de eventos</h3>
            <div class="row">
                <div class="col">
                    Acciones
                </div>

            </div>

            <div class="row mt-3">
                <div class="col">
                    <div class="col">

                        @can('solicitudes.crear')
                            <a href="{{ route('solicitudes.create') }}" class="btn btn-success">Crear Nueva Solicitud</a>

                        @endcan
                    </div>
                </div>
                <div class="col">
                <form method="GET" action="{{ route('solicitudes.index') }}" class="d-flex mb-3">
                    <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar" value="{{ request('buscar') }}">
                    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-frame card-profile-bottom">
    <div class="card-body">
        <p>Filtrar por:</p>
        <div class="row justify-content-center d-flex mb-3">
            <div class="col-md-2">
                <form method="GET" action="{{ route('solicitudes.index') }}">
                    <input type="hidden" name="estado_aprobacion" value="3">
                    <button type="submit" class="btn btn-sm btn-primary w-100">
                        Aprobado Manual
                    </button>
                </form>
            </div>

            <div class="col-md-3">
                <form method="GET" action="{{ route('solicitudes.index') }}">
                    <input type="hidden" name="estado_aprobacion" value="2">
                    <button type="submit" class="btn btn-sm btn-success w-100">
                        Aprobado Automático
                    </button>
                </form>
            </div>

            <div class="col-md-2">
                <form method="GET" action="{{ route('solicitudes.index') }}">
                    <input type="hidden" name="estado_aprobacion" value="1">
                    <button type="submit" class="btn btn-sm btn-warning w-100">
                        Pendientes
                    </button>
                </form>
            </div>

            <div class="col-md-2">
                <form method="GET" action="{{ route('solicitudes.index') }}">
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
<div class="table-responsive">
<table class="table table-bordered table-striped mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Solicitud</th>
                        <th>Fecha de registro</th>
                        <th>Fecha solicitada</th>
                       
                        <th>Estado Aprobacion</th>
                        <th>seguimiento</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud->titulo }}</td>
                            
                            <td>{{ \Carbon\Carbon::parse($solicitud->created_at)->format('d/m/Y H:i') }}</td>

                            <td>{{ \Carbon\Carbon::parse($solicitud->fecha)->format('d/m/Y') }}</td>
                          
                            <td>
                                @switch($solicitud->estado_aprobacion)
                                    @case(1)
                                        <span class="badge bg-warning text-white">Pendiente</span>
                                        @break
                                    @case(2)
                                        <span class="badge bg-success">Aprobado Automático</span>
                                        @break
                                    @case(3)
                                        <span class="badge bg-primary">Aprobado Manual</span>
                                        @break
                                    @case(4)
                                        <span class="badge bg-dark">Rechazado</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">Desconocido</span>
                                @endswitch
                            </td>
                            <td>
                                <div style="max-width: 300px; overflow-x: auto; white-space: nowrap;">
                                    @forelse ($solicitud->seguimientos as $seguimiento)
                                        <p>{!! $seguimiento->mensaje !!}</p>
                                    @empty
                                        <p>No hay seguimiento</p>
                                    @endforelse
                                </div>
                            </td>
                            <td class="text-center">
                                @php
                                    $fechaEvento = \Carbon\Carbon::parse($solicitud->fecha);
                                    $hoy = \Carbon\Carbon::now();
                                    $diasDiferencia = $hoy->diffInDays($fechaEvento, false);
                                @endphp

                                <div class="d-flex flex-column align-items-center gap-1">
                                    @if ($solicitud->estado_aprobacion == 1)
                                        <a href="{{ route('solicitudes.show', $solicitud) }}" class="btn btn-sm w-100 {{ $diasDiferencia >= 3 ? 'btn-success' : 'btn-warning' }}">
                                            <i class="fas fa-eye"></i> Aprobar
                                        </a>
                                    @else
                                        <a href="{{ route('solicitud.detalle',$solicitud) }}" class="btn btn-sm btn-info w-100">
                                            <i class="fas fa-check-circle"></i> Detalle
                                        </a>
                                    @endif

                                    <a href="{{ route('solicitudes.edit', $solicitud) }}" class="btn btn-sm btn-primary w-100">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('solicitudes.destroy', $solicitud) }}" method="POST" class="w-100">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100"
                                            onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $solicitudes->links('pagination::bootstrap-4') }}
            </div>
</div>
            

        </div>
    </div>


@endsection