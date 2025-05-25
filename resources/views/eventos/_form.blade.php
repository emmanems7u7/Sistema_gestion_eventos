@csrf
@if(isset($evento))
    @method('PUT')
@endif
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="titulo" class="form-label">Título:</label>
        <input type="text" name="titulo" id="titulo" class="form-control"
            value="{{ old('titulo', $evento->titulo ?? '') }}" required>
        @error('titulo')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="fecha" class="form-label">Fecha:</label>
        <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror"
            value="{{ old('fecha', $evento->fecha ?? '') }}" required>
        @error('fecha')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="hora_inicio" class="form-label">Hora de inicio:</label>
        <input type="time" name="hora_inicio" id="hora_inicio"
            class="form-control @error('hora_inicio') is-invalid @enderror"
            value="{{ old('hora_inicio', $evento->hora_inicio ?? '') }}">
        @error('hora_inicio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="hora_fin" class="form-label">Hora de finalización:</label>
        <input type="time" name="hora_fin" id="hora_fin" class="form-control @error('hora_fin') is-invalid @enderror"
            value="{{ old('hora_fin', $evento->hora_fin ?? '') }}">
        @error('hora_fin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="ubicacion" class="form-label">Ubicación:</label>
        <input type="text" name="ubicacion" id="ubicacion" class="form-control"
            value="{{ old('ubicacion', $evento->ubicacion ?? '') }}">
        @error('ubicacion')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="geolocalizacion" class="form-label">Geolocalización:</label>
        <input type="text" name="geolocalizacion" id="geolocalizacion" class="form-control"
            value="{{ old('geolocalizacion', $evento->geolocalizacion ?? '') }}" readonly data-bs-toggle="modal"
            data-bs-target="#mapModal">
        @error('geolocalizacion')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="estado" class="form-label">Estado:</label>
        <select name="estado" id="estado" class="form-select" required>
            <option value="1" {{ old('estado', $evento->estado ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ old('estado', $evento->estado ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
        </select>
        @error('estado')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea name="descripcion" id="descripcion" class="form-control"
            rows="3">{{ old('descripcion', $evento->descripcion ?? '') }}</textarea>
        @error('descripcion')
            <div style="color:red;">{{ $message }}</div>
        @enderror
    </div>
</div>


<button type="submit" class="btn btn-primary">{{ isset($evento) ? 'Actualizar' : 'Guardar' }}</button>


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
    let map, marker;

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('mapModal');

        modal.addEventListener('shown.bs.modal', function () {
            if (!map) {
                map = L.map('leaflet-map').setView([-16.5, -68.15], 13); // Ajusta la ubicación inicial

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
            }

            setTimeout(() => map.invalidateSize(), 200); // Forzar redibujo del mapa
        });
    });

    function setMarkerAndInput(latlng) {
        if (marker) map.removeLayer(marker);
        marker = L.marker(latlng).addTo(map);
        document.getElementById('geolocalizacion').value = `${latlng.lat},${latlng.lng}`;
    }
</script>