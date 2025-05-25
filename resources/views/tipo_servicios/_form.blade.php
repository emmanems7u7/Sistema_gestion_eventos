@csrf

<div class="mb-3">
    <label for="servicio_id" class="form-label">Servicio</label>
    <input type="text" class="form-control" value="{{ $servicio->nombre }}" disabled>
    <input type="hidden" name="servicio_id" id="servicio_id" value="{{ $servicio->id }}">

    <p class="mt-2">Descripcion: {{ $servicio->descripcion }}</p>
</div>

<div class="mb-3">
    <label for="tipo" class="form-label">Tipo</label>
    <input type="text" class="form-control @error('tipo') is-invalid @enderror" name="tipo" id="tipo"
        value="{{ old('tipo', $tipoServicio->tipo ?? '') }}" required>

    @error('tipo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="caracteristicas" class="form-label">Características</label>
    <textarea class="form-control @error('caracteristicas') is-invalid @enderror" name="caracteristicas"
        id="caracteristicas">{{ old('caracteristicas', $tipoServicio->caracteristicas ?? '') }}</textarea>
    @error('caracteristicas')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="categoria_id" class="form-label">Categoría</label>
    <select class="form-control @error('categoria_id') is-invalid @enderror" name="categoria_id" id="categoria_id"
        required onchange="cargarSubcategorias(this.value)">
        <option value="" disabled selected>Seleccione categoría</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ (string) old('categoria', $tipoServicio->categoria_id ?? '') === (string) $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
    @error('categoria')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="catalogo_id" class="form-label">Seleccionar Categoria para servicio</label>
    <select class="form-control" name="catalogo_id" id="catalogo_id">
        <option value="" disabled selected>Seleccione</option>
    </select>
</div>

<style>
    .inventario-card {
        cursor: pointer;
        transition: border 0.3s ease;
        border: 2px solid transparent;
    }

    .btn-check:checked+.inventario-card {
        border-color: #0d6efd;
        /* Azul Bootstrap */
    }

    .inventario-card:hover {
        border-color: #b6d4fe;
    }
</style>

<label for="search" class="d-block mb-2">Seleccione el equipo que se utilizará</label>

<p class="text-info">Si no encuentras el equipo puedes paginar la lista para encontrar el registrado</p>

<div id="inventarios-container">
    @include('tipo_servicios._inventarios')
</div>


@error('inventario_id')
    <div class="text-danger">{{ $message }}</div>
@enderror


<div class="mb-3">
    <label for="cantidad_equipo" class="form-label">Cantidad de Equipo</label>
    <input type="number" class="form-control @error('cantidad_equipo') is-invalid @enderror" name="cantidad_equipo"
        id="cantidad_equipo" value="{{ old('cantidad_equipo', $tipoServicio->cantidad_equipo ?? '') }}">
    @error('cantidad_equipo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="cantidad_personal" class="form-label">Cantidad de personal</label>
    <input type="number" class="form-control @error('cantidad_personal') is-invalid @enderror" name="cantidad_personal"
        id="cantidad_personal" value="{{ old('cantidad_personal', $tipoServicio->cantidad_personal ?? '') }}">
    @error('cantidad_personal')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>



<div class="mb-3">
    <label for="precio" class="form-label">Precio (Por hora )</label>
    <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" name="precio"
        id="precio" value="{{ old('precio', $tipoServicio->precio ?? '') }}">
    @error('precio')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


<button type="submit" class="btn btn-primary">{{ isset($tipoServicio) ? 'Actualizar' : 'Crear' }}</button>


<script>


    document.addEventListener('DOMContentLoaded', function () {

        const categoriaSelect = document.getElementById('categoria_id');
        if (categoriaSelect && categoriaSelect.value) {

            cargarSubcategorias(categoriaSelect.value);
        }
    });
</script>
<script>
    const catalogoIdSeleccionado = "{{ old('catalogo_id', $tipoServicio->catalogo_id ?? '') }}"
    function cargarSubcategorias(categoriaId) {
        fetch(`/subcategorias/por-categoria/${categoriaId}`)
            .then(response => response.json())
            .then(data => {
                const subcategoriaSelect = document.getElementById('catalogo_id');
                subcategoriaSelect.innerHTML = '<option value="" disabled>Seleccione subcategoría</option>';

                data.forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub.catalogo_codigo;
                    option.textContent = sub.catalogo_descripcion;

                    if (sub.catalogo_codigo === catalogoIdSeleccionado) {
                        option.selected = true;
                    }

                    subcategoriaSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error cargando subcategorías:', error);
            });
    }
</script>