@if(!$inventarios->isEmpty())
    <div class="row">

        @foreach($inventarios as $inventario)
            <div class="col-md-3 mb-3">
                <input type="radio" class="btn-check" name="inventario_id" id="inventario_{{ $inventario->id }}"
                    value="{{ $inventario->id }}" autocomplete="off" {{ old('inventario_id', $tipoServicio->inventario_id ?? '') == $inventario->id ? 'checked' : '' }}>

                <label class="card inventario-card w-100" for="inventario_{{ $inventario->id }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $inventario->nombre }}</h5>
                        <p class="card-text">{{ $inventario->descripcion }}</p>
                    </div>
                </label>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $inventarios->links('pagination::bootstrap-4') }}
    </div>
@endif

<script>
    document.addEventListener('click', function (e) {
        if (e.target.matches('#inventarios-container .pagination a')) {
            e.preventDefault();
            const url = e.target.href;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('inventarios-container').innerHTML = html;
                })
                .catch(err => console.error('Error al cargar paginación:', err));
        }
    });

</script>