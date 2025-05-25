@csrf
@if(isset($solicitud))
    @method('PUT')
@endif


<div class="card shadow-lg  card-profile-bottom">

    <div class="card-body">

        <h6>Datos del cliente</h6>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="{{ old('nombre', $cliente->nombre ?? '') }}" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="ape_pat" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="ape_pat" name="ape_pat"
                    value="{{ old('ape_pat', $cliente->ape_pat ?? '') }}" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="ape_mat" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="ape_mat" name="ape_mat"
                    value="{{ old('ape_mat', $cliente->ape_mat ?? '') }}">
            </div>

            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $cliente->email ?? '') }}" required>
            </div>

            <div class="mb-3 col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono"
                    value="{{ old('telefono', $cliente->telefono ?? '') }}">
            </div>
        </div>
    </div>
</div>

<div class="card shadow-lg  card-profile-bottom mt-3">

    <div class="card-body">
        <h6>Datos de la solicitud del evento</h6>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control"
                    value="{{ old('titulo', $solicitud->titulo ?? '') }}" required>
                @error('titulo') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror"
                    value="{{ old('fecha', $solicitud->fecha ?? '') }}" required>
                @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="hora_inicio" class="form-label">Hora de inicio</label>
                <input type="time" name="hora_inicio" id="hora_inicio"
                    value="{{ old('hora_inicio', isset($solicitud) ? \Carbon\Carbon::parse($solicitud->hora_inicio)->format('H:i') : '') }}"
                    class="form-control @error('hora_inicio') is-invalid @enderror">
                @error('hora_inicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="hora_fin" class="form-label">Hora de finalización</label>
                <input type="time" name="hora_fin" id="hora_fin"
                    value="{{ old('hora_fin', isset($solicitud) ? \Carbon\Carbon::parse($solicitud->hora_fin)->format('H:i') : '') }}"
                    class="form-control @error('hora_fin') is-invalid @enderror">
                @error('hora_fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="ubicacion" class="form-label">Ubicación:</label>
                <input type="text" name="ubicacion" id="ubicacion" class="form-control"
                    value="{{ old('ubicacion', $solicitud->ubicacion ?? '') }}">
                @error('ubicacion') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="geolocalizacion" class="form-label">Geolocalización:</label>
                <input type="text" name="geolocalizacion" id="geolocalizacion" class="form-control"
                    value="{{ old('geolocalizacion', $solicitud->geolocalizacion ?? '') }}" readonly
                    data-bs-toggle="modal" data-bs-target="#mapModal">
                @error('geolocalizacion') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion"
                class="form-control">{{ old('descripcion', $solicitud->descripcion ?? '') }}</textarea>
            @error('descripcion') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <hr>

        <h6>Servicios</h6>
        <div class="mb-3 d-flex flex-wrap gap-3">
            @foreach($servicios as $servicio)
                <div>
                    <input type="checkbox" class="btn-check" name="servicio_checkbox[]" id="servicio{{ $servicio->id }}"
                        value="{{ $servicio->id }}" autocomplete="off"
                        onclick="handleServicioSeleccionado({{ $servicio->id }})" @checked(
                            (isset($solicitud) && $solicitud->servicios->contains('id', $servicio->id)) ||
                            in_array($servicio->id, old('servicio_checkbox', []))
                        )>

                    <label class="btn btn-outline-primary d-flex align-items-center justify-content-center"
                        for="servicio{{ $servicio->id }}"
                        style="width: 150px; height: 50px; white-space: nowrap; text-align: center;">
                        {{ $servicio->nombre }}
                    </label>

                    <div id="planes-container-{{ $servicio->id }}" class="d-flex flex-wrap gap-3 mt-2"></div>

                    @if($errors->has('servicio_checkbox.*'))
                        <div class="text-danger">{{ $errors->first('servicio_checkbox.*') }}</div>
                    @endif
                </div>
            @endforeach
            <input type="hidden" name="servicios_seleccionados" id="servicios_seleccionados"
                value="{{ old('servicios_seleccionados') }}">
        </div>

        @if($errors->any())
            <div class="alert alert-danger mt-2">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div class="card shadow-lg card-profile-bottom mt-4" id="contenedor_costo" style="display: none;">
            <div class="card-body text-center">
                <strong>Costo Total del Evento</strong>
                <p class="mb-2">Basado en los servicios seleccionados y la duración del evento:</p>
                <h4 class="text-success fw-bold" id="total_"></h4>
            </div>
        </div>

    </div>
</div>
<div class="card shadow-lg mt-3">
    <div class="card-body">
        <h6>Acciones</h6>
        <div class="row">

            <div class="col-md-6 mb-2">
                <button type="submit" id="btn-submit" class="btn btn-primary w-100 text-white"
                    style="color:white !important;">
                    Crear Solicitud
                </button>
            </div>

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
        const geolocalizacionInput = document.getElementById('geolocalizacion');

        // Evento al abrir el modal
        modal.addEventListener('shown.bs.modal', function () {
            if (!map) {
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

                // Geocoder
                L.Control.geocoder({
                    defaultMarkGeocode: false
                }).on('markgeocode', function (e) {
                    const latlng = e.geocode.center;
                    map.setView(latlng, 16);
                    setMarkerAndInput(latlng);
                }).addTo(map);

                map.on('click', function (e) {
                    setMarkerAndInput(e.latlng);
                });

                setMarkerAndInput(coords);
            }

            setTimeout(() => map.invalidateSize(), 200); // Redibujo
        });

        // Evento al cerrar el modal
        modal.addEventListener('hidden.bs.modal', function () {
            const value = geolocalizacionInput.value.trim();
            if (value === "undefined,undefined" || value === "") {
                // Volver a abrir el modal después de un breve retardo
                setTimeout(() => {

                    geolocalizacionInput.click();
                }, 300);
            }
        });
    });

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
                        <p class="card-text"><strong>Precio:</strong> Bs.${plan.precio}</p>
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


        // Actualiza el valor del campo oculto con el objeto JSON
        document.getElementById('servicios_seleccionados').value = JSON.stringify(serviciosSeleccionados);
        validarprecios()
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

<script>


    function validarprecios() {

        const formData = new FormData();
        formData.append('fecha', document.getElementById('fecha').value);
        formData.append('hora_inicio', document.getElementById('hora_inicio').value);
        formData.append('hora_fin', document.getElementById('hora_fin').value);
        formData.append('servicios_seleccionados', document.getElementById('servicios_seleccionados').value);
        const el = document.getElementById('contenedor_costo');
        fetch('/precio/solicitud', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 1) {

                    document.getElementById('total_').textContent = `Bs. ${data.total}`;
                    el.style.display = 'block';

                }


            })
            .catch(error => {
                console.error("Error validar la solicitud:", error);
            });

    }
</script>