@extends('layouts.argon')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <p>Servicios</p>
            <div class="row mt-3">
                <div class="col">
                    <a href="{{ route('servicios.create') }}" class="btn btn-primary">
                        {!!   __('ui.create')!!} Servicio
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        @foreach($servicios as $servicio)
            <div class="col-6 mb-4">
                <div class="card shadow-sm border">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            <i class="fas fa-briefcase me-2"></i> {{ $servicio->nombre }}
                        </h5>

                        <div class="row">
                            <div class="col">
                                @if($servicio->imagen)
                                    <img src="{{ asset('storage/' . $servicio->imagen) }}" alt="Imagen"
                                        class="img-fluid rounded mb-2" style="max-height: 150px;">
                                @endif

                            </div>
                            <div class="col">
                                <p class="text-muted mb-1">
                                    <strong>Descripción:</strong>
                                <p>{{ Str::limit($servicio->descripcion, 100) }}</p>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($servicio->tipos as $tipo)
                                <div class="col-md-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row gy-2">
                                                <div class="col-4"><strong>Tipo:</strong> {{ $tipo->tipo }}</div>
                                                <div class="col-8 text-end"><strong>Categoría:</strong>
                                                    {{ App\Models\Catalogo::where('catalogo_codigo', $tipo->catalogo_id)->first()->catalogo_descripcion ?? 'No tiene categoria' }}
                                                </div>
                                                <div class="col-12"><strong>Características:</strong> {{ $tipo->caracteristicas }}
                                                </div>
                                                <div class="col-6"><strong>Equipo:</strong> {{ $tipo->cantidad_equipo }}</div>
                                                <div class="col-6"><strong>Personal:</strong> {{ $tipo->cantidad_personal }}</div>
                                                <div class="col-6"><strong>Precio por hora:</strong>
                                                    Bs.{{ number_format($tipo->precio, 2) }}</div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex justify-content-between align-items-center">
                                            <form action="{{ route('tipo_servicios.destroy', $tipo) }}" method="POST"
                                                id="delete-form-{{ $servicio->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger me-2"
                                                    onclick="confirmDelete('{{ $servicio->id }}','¿Estás seguro de eliminar este tipo de servicio?')">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>

                                            </form>
                                            <a href="{{ route('tipo_servicios.edit', $tipo) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST"
                            id="delete-form-{{ $servicio->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger me-2"
                                onclick="confirmDelete({{ $servicio->id }},'¿Estás seguro de eliminar este servicio?')">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>

                        <a href="{{ route('tipo_servicios.create', $servicio) }}" class="btn btn-sm btn-info me-2">
                            <i class="fas fa-plus-circle"></i> Agregar componentes
                        </a>

                        <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


@endsection