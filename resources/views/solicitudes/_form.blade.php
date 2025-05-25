@csrf
@if(isset($solicitud))
    @method('PUT')
@endif


<div class="card shadow-lg  card-profile-bottom">

    <div class="card-body">
        <h6>Datos del cliente</h6>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ old('nombre', $cliente->nombre ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="ape_pat" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" id="ape_pat" name="ape_pat"
                value="{{ old('ape_pat', $cliente->ape_pat ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="ape_mat" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" id="ape_mat" name="ape_mat"
                value="{{ old('ape_mat', $cliente->ape_mat ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email', $cliente->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono"
                value="{{ old('telefono', $cliente->telefono ?? '') }}">
        </div>
    </div>
</div>

<div class="card shadow-lg  card-profile-bottom">

    <div class="card-body">
        <h6>Datos de la solicitud del evento</h6>
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control"
                value="{{ old('titulo', $solicitud->titulo ?? '') }}" required>
            @error('titulo')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion"
                class="form-control">{{ old('descripcion', $solicitud->descripcion ?? '') }}</textarea>
            @error('descripcion')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror"
                value="{{ old('fecha', $solicitud->fecha ?? '') }}" required>
            @error('fecha')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="form-label">Hora de inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio"
                value="{{ old('hora_inicio', isset($solicitud) ? \Carbon\Carbon::parse($solicitud->hora_inicio)->format('H:i') : '') }}"
                class="form-control @error('hora_inicio') is-invalid @enderror">
            @error('hora_inicio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="hora_fin" class="form-label">Hora de finalización</label>
            <input type="time" name="hora_fin" id="hora_fin"
                value="{{ old('hora_fin', isset($solicitud) ? \Carbon\Carbon::parse($solicitud->hora_fin)->format('H:i') : '') }}"
                class="form-control @error('hora_fin') is-invalid @enderror">
            @error('hora_fin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación:</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-control"
                value="{{ old('ubicacion', $solicitud->ubicacion ?? '') }}">
            @error('ubicacion')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="geolocalizacion" class="form-label">Geolocalización:</label>
            <input type="text" name="geolocalizacion" id="geolocalizacion" class="form-control"
                value="{{ old('geolocalizacion', $solicitud->geolocalizacion ?? '') }}" readonly data-bs-toggle="modal"
                data-bs-target="#mapModal">
            @error('geolocalizacion')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <style>
            .btn-check:checked+.btn-outline-primary {
                background-color: transparent !important;
                /* Sin fondo */
                border-color: #0d6efd !important;
                /* Borde azul bootstrap */
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
                /* Sombra sutil azul */
                color: #0d6efd !important;
                /* Texto azul */
            }
        </style>
        <div class="mb-3">
            @foreach($servicios as $servicio)
                <!-- Checkbox del servicio -->
                <input type="checkbox" class="btn-check" name="servicio_checkbox[]" id="servicio{{ $servicio->id }}"
                    value="{{ $servicio->id }}" autocomplete="off" onclick="handleServicioSeleccionado({{ $servicio->id }})"
                    @checked(
                        (isset($solicitud) && $solicitud->servicios->contains('id', $servicio->id)) ||
                        in_array($servicio->id, old('servicio_checkbox', []))
                    )>

                <label class="btn btn-outline-primary d-flex align-items-center justify-content-center"
                    for="servicio{{ $servicio->id }}"
                    style="width: 150px; height: 50px; white-space: nowrap; text-align: center;">
                    {{ $servicio->nombre }}
                </label>

                <!-- Contenedor específico para los planes del servicio -->
                <div id="planes-container-{{ $servicio->id }}" class="d-flex flex-wrap gap-3 mt-3 mb-3">
                    <!-- Aquí se pueden cargar los planes disponibles para cada servicio en JS -->
                </div>

                @if($errors->has('servicio_checkbox.*'))
                    <div class="text-danger">
                        <p>{{ $errors->first('servicio_checkbox.*') }}</p>
                    </div>
                @endif
            @endforeach
            <input type="hidden" name="servicios_seleccionados" id="servicios_seleccionados"
                value="{{ old('servicios_seleccionados') }}">

            <!-- Mostrar errores generales -->
            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="1" {{ old('estado', $solicitud->estado ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('estado', $solicitud->estado ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>
        <div class="card shadow-lg  card-profile-bottom" id="contenedor_costo" style="display: none;">
            <div class="mb-3">
                <div class="card-body text-center">
                    <strong>Costo Total del Evento</strong>
                    <p class="mb-2">Basado en los servicios seleccionados y la duración del evento:</p>
                    <h4 class="text-success fw-bold" id="total_"></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-lg  card-profile-bottom">
    <div class="card-body">
        <h6>Acciones</h6>
        <div class="row">

            @can('solicitudes.validar')
                <div class="col-md-6 mb-2">
                    <a class="btn btn-warning w-100" onclick="ValidarSolicitud()">Validar</a>
                </div>

            @endcan
            @can('solicitudes.actualizar')
                <div class="col-md-6 mb-2">
                    <button type="submit" id="btn-submit" class="btn btn-primary w-100" {{ isset($solicitud) ? '' : 'disabled' }}>
                        {{ isset($solicitud) ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            @endcan
        </div>
    </div>
</div>



<!-- Modal con Mapa -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecciona una ubicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="height: 500px;">
                <div id="leaflet-map" style="height: 100%; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>


<script>
    function ValidarSolicitud() {
        const formData = new FormData();
        formData.append('fecha', document.getElementById('fecha').value);
        formData.append('hora_inicio', document.getElementById('hora_inicio').value);
        formData.append('hora_fin', document.getElementById('hora_fin').value);
        formData.append('servicios_seleccionados', document.getElementById('servicios_seleccionados').value);
        const el = document.getElementById('contenedor_costo');
        fetch('/validar/solicitud', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 1) {
                    alertify.alert('La Solicitud puede ser Aprobada', data.mensaje, () => {
                        alertify.success('Validacion Completada');
                    });
                    document.getElementById('btn-submit').disabled = false;
                    document.getElementById('total_').textContent = `Bs. ${data.total}`;

                    el.style.display = 'block';

                } else if (data.status === 0) {
                    alertify.alert('La Solicitud no puede ser Aprobada', data.mensaje, () => {
                        alertify.error('No cumple con los requisitos');
                    });
                    @if(!isset($solicitud))
                        document.getElementById('btn-submit').disabled = true;
                    @endif


                    el.style.display = 'none';
                } else if (data.status === 3) {

                    for (const campo in data.errors) {
                        data.errors[campo].forEach(msg => {
                            alertify.error(msg);
                        });
                    }
                    @if(!isset($solicitud))
                        document.getElementById('btn-submit').disabled = true;
                    @endif
                    el.style.display = 'none';
                }


            })
            .catch(error => {
                console.error("Error validar la solicitud:", error);
            });

    }
</script>
<style>
    .card.selected {
        border: 2px solid #0d6efd;
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
    }
</style>

<script>
    let map, marker;
    let ubicacionInicial = @json($solicitud->geolocalizacion ?? null);

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('mapModal');

        modal.addEventListener('shown.bs.modal', function () {
            if (!map) {
                // Coordenadas por defecto (en caso de que no haya una ubicación inicial)
                const defaultCoords = [-16.5, -68.15];
                let coords = defaultCoords;

                if (ubicacionInicial) {
                    const parts = ubicacionInicial.split(',');
                    if (parts.length === 2) {
                        coords = [parseFloat(parts[0]), parseFloat(parts[1])];
                    }
                }

                map = L.map('leaflet-map').setView(coords, 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                // Geocoder (buscador de calles)
                L.Control.geocoder({
                    defaultMarkGeocode: false
                })
                    .on('markgeocode', function (e) {
                        const latlng = e.geocode.center;
                        map.setView(latlng, 16);
                        setMarkerAndInput(latlng);
                    })
                    .addTo(map);

                // Click en el mapa
                map.on('click', function (e) {
                    setMarkerAndInput(e.latlng);
                });

                // Inicializa el marcador y el campo de entrada con las coordenadas actuales
                setMarkerAndInput(coords);
            }

            setTimeout(() => map.invalidateSize(), 200); // Forzar redibujo del mapa
        });
    });

    // Esta función coloca el marcador y actualiza el valor en el input
    function setMarkerAndInput(latlng) {
        if (marker) map.removeLayer(marker);
        marker = L.marker(latlng).addTo(map);
        document.getElementById('geolocalizacion').value = `${latlng.lat},${latlng.lng}`;
    }
</script>
@php
    // Inicializamos la variable para los planes seleccionados
    $planesSeleccionados = [];

    // Verificamos si la solicitud tiene servicios
    if (isset($solicitud) && $solicitud->servicios->count() > 0) {
        foreach ($solicitud->servicios as $servicio) {
            // Filtramos los servicios con valor null
            if ($servicio->id !== null) {
                $planesSeleccionados[$servicio->id] = $servicio->pivot->tipo_servicio_id;
            }
        }
    }




@endphp
<script>
    <?php if (!empty($planesSeleccionados)):?>
    let serviciosSeleccionados = @json($planesSeleccionados);
    actualizarServicioSeleccionado()
    <?php else: ?>
    let serviciosSeleccionados = {}
    <?php endif ?>

    function handleServicioSeleccionado(servicioId) {
        const servicioCheckbox = document.getElementById('servicio' + servicioId);
        if (servicioCheckbox.checked) {
            // Si el servicio es seleccionado, se cargan sus planes
            agregarServicio(servicioId);
        } else {
            // Si el servicio es deseleccionado, se eliminan sus planes
            eliminarPlanes(servicioId);
        }
    }

    function agregarServicio(id) {
        fetch('/tipos/por-servicio/' + id, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('planes-container-' + id); // Usamos un contenedor específico por servicio
                const selectedPlanId = serviciosSeleccionados[id] || null;
                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = '<p class="text-muted">No hay planes disponibles.</p>';
                    return;
                }

                data.forEach(plan => {
                    const card = document.createElement('div');
                    card.className = 'card';
                    card.style.width = '18rem';
                    card.style.cursor = 'pointer';
                    card.dataset.id = plan.id;

                    // Verifica si este plan es el seleccionado para este servicio
                    if (String(plan.id) === String(selectedPlanId)) {
                        card.classList.add('selected');
                    }

                    card.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${plan.tipo}</h5>
                        <p class="card-text">${plan.caracteristicas}</p>
                        <p class="card-text"><strong>Precio:</strong> $${plan.precio}</p>
                    </div>
                `;

                    card.addEventListener('click', () => {
                        // Actualiza la selección de plan para este servicio
                        document.querySelectorAll(`#planes-container-${id} .card`).forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        serviciosSeleccionados[id] = plan.id; // Guarda el plan seleccionado para este servicio

                        // Actualiza el array de servicios seleccionados
                        actualizarServicioSeleccionado();
                    });

                    container.appendChild(card);
                });
            })
            .catch(error => {
                console.error("Error al obtener los planes:", error);
            });
        console.log(serviciosSeleccionados);
    }

    // Función para eliminar los planes de un servicio cuando se deselecciona
    function eliminarPlanes(servicioId) {
        const container = document.getElementById('planes-container-' + servicioId);
        container.innerHTML = '';  // Elimina los planes del contenedor
        delete serviciosSeleccionados[servicioId];  // Elimina el servicio y su plan asociado
        actualizarServicioSeleccionado();  // Actualiza el estado de los servicios seleccionados
    }

    // Actualiza el array de servicios y planes seleccionados
    function actualizarServicioSeleccionado() {
        console.log("Servicios seleccionados: ", serviciosSeleccionados);

        // Actualiza el valor del campo oculto con el objeto JSON
        document.getElementById('servicios_seleccionados').value = JSON.stringify(serviciosSeleccionados);
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Inicializa todos los servicios al cargar la página
        const servicioIds = document.querySelectorAll('input[name="servicio_checkbox[]"]:checked');
        servicioIds.forEach(servicio => {
            const servicioId = servicio.value;
            agregarServicio(servicioId);
        });
    });
</script>