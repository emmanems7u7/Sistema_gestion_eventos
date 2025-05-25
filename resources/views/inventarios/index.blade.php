@extends('layouts.argon')

@section('content')
    <style>
        /* Reducir el tamaño de los enlaces de la paginación */
        .pagination .page-link {
            font-size: 0.15rem !important;
            /* Reducir el tamaño de la fuente */
            padding: 0.25rem 0.5rem !important;
            /* Reducir el padding */
        }

        /* Reducir el tamaño de los iconos de las flechas */
        .pagination .page-link i {
            font-size: 0.8rem !important;
            /* Reducir aún más el tamaño de los iconos */
        }

        .card-body .text-primary {
            font-size: 1rem;
            font-weight: bold;
            margin-right: 0.5rem;
        }

        .card-body p {
            margin-bottom: 0.5rem;
        }

        .card-body h5 {
            margin-bottom: 0.75rem;
        }

        .image-container {
            position: relative;
        }

        .image-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .image-container button {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 16px;
            color: white;
            background: red;
            border: none;
            padding: 2px 5px;
            cursor: pointer;
        }

        .image-container button:hover {
            background: darkred;
        }
    </style>

    <div class="card card-frame card-profile-bottom">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    Acciones
                </div>

            </div>

            <div class="row mt-3">
                <div class="col">
                    <div class="col">

                        @can('inventarios.crear')
                            <button class="btn btn-info mb-3" onclick="crear()">Añadir componente</button>
                        @endcan

                    </div>
                    <div class="col">
                        <form action="{{ route('inventarios.index') }}" method="get" class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar inventarios"
                                    value="{{ old('search', $search) }}">
                                <button class="btn btn-primary" type="submit">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-3">

        <div class="row">
            @foreach ($inventarios as $inventario)
                <div class="col-md-12 mb-4" id="inventario_{{ $inventario->id }}">
                    <div class="card shadow-sm rounded-lg position-relative">
                        <div class="card-body">
                            <!-- Fecha de adquisición en la parte superior derecha -->
                            <p class="card-text text-muted position-absolute"
                                style="top: 10px; right: 10px; font-size: 0.85rem;">
                                <span class="font-weight-bold">Fecha de adquisición:</span>
                                {{ $inventario->fecha_adquisicion }}
                            </p>

                            <!-- Nombre -->
                            <h5 class="card-title">
                                <span class="font-weight-bold">Nombre:</span> {{ $inventario->nombre }}
                            </h5>
                            <!-- Nombre -->
                            <p class="card-title">
                                <span class="font-weight-bold">Categoria:</span>
                                {{  App\Models\Catalogo::where('catalogo_codigo', $inventario->categoria)->first()->catalogo_descripcion }}
                            </p>

                            <!-- Descripción -->
                            <p class="card-text">
                                <span class="font-weight-bold">Descripción:</span>
                                {{ Str::limit($inventario->descripcion, 100) }}
                            </p>

                            <!-- Cantidad Disponible con colores -->
                            @php
                                $cantidadMaxima = 100; // Establece el valor máximo según tus necesidades
                                $cantidadDisponible = $inventario->cantidad_disponible;
                                $color = '';
                                $alerta = '';

                                if ($cantidadDisponible > $cantidadMaxima / 2) {
                                    $color = 'text-success'; // Verde
                                    $alerta = 'Stock suficiente';
                                } elseif ($cantidadDisponible == $cantidadMaxima / 2) {
                                    $color = 'text-warning'; // Amarillo
                                    $alerta = 'Stock medio';
                                } else {
                                    $color = 'text-danger'; // Rojo
                                    $alerta = '¡Alerta! Bajo stock';
                                }
                            @endphp

                            <p class="card-text">
                                <span class="font-weight-bold">Cantidad Disponible:</span>
                                <span class="{{ $color }}">{{ $cantidadDisponible }}</span>
                            </p>

                            <!-- Frecuencia de Mantenimiento -->
                            <p class="card-text">
                                <span class="font-weight-bold">Frecuencia de Mantenimiento:</span>
                                {{ $inventario->frecuencia_mantenimiento }}
                            </p>

                            <!-- Estado -->
                            <p class="card-text">
                                <span class="font-weight-bold">Estado:</span>
                                {{ $inventario->estado ? 'Activo' : 'Inactivo' }}
                            </p>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">Imágenes:</h6>
                                    <!-- Botón para abrir el modal -->
                                    @can('inventarios.agregar_imagen')
                                        <button class="btn btn-primary" onclick="ModalImagenes(' {{ $inventario->id }}')">
                                            <i class="fas fa-plus"></i> Agregar Imagen
                                        </button>
                                    @endcan
                                    @if ($inventario->imagenes->isEmpty())
                                        <p class="text-muted">No tiene imágenes.</p>
                                    @else
                                        <div class="row mt-3">
                                            @foreach ($inventario->imagenes as $imagen)
                                                <div class="col-md-2 mb-3 position-relative" id="imagen-{{ $imagen->id }}">
                                                    <img src="{{ Storage::url($imagen->ruta) }}"
                                                        alt="Imagen de {{ $inventario->nombre }}" class="img-fluid rounded">
                                                    <!-- Botón de eliminar imagen -->
                                                    <button style="    right: 5px;"
                                                        class="btn btn-danger btn-sm position-absolute top-0 right-0 m-2"
                                                        onclick="confirmDelete('{{ $imagen->id }}')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Botones de acción -->
                            <div class="d-flex justify-content-end mt-3">
                                @can('inventarios.editar')
                                    <button onclick="Editar('{{ $inventario->id }}')" class="btn btn-warning btn-sm mr-2">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                @endcan
                                @can('inventarios.eliminar')
                                    <button onclick="EliminarInventario('{{ $inventario->id }}')"
                                        class="btn btn-danger btn-sm mr-2">
                                        <i class="fas fa-edit"></i> Eliminar
                                    </button>
                                @endcan

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $inventarios->links() }}
        </div>

    </div>


    <!-- Modal para agregar imagenes -->
    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Subir Nueva Imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('inventarios.agregarImagen') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="inventario_id" id="inventario_id">

                        <div class="form-group">
                            <label for="images">Seleccionar imágenes</label>
                            <input type="file" name="images[]" id="imageInput" multiple
                                onchange="previewImages('imagePreview','imageInput')">
                        </div>

                        <div id="imagePreview" class="d-flex flex-wrap">
                            <!-- Las imágenes se previsualizarán aquí -->
                        </div>
                        <button type="submit" class="btn btn-success">Subir Imagen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal para Crear/Editar Inventario -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Crear Componente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="InventarioForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="formMethod" name="_method">

                        <!-- Campo Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <!-- Campo Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>

                        <!-- Campo Cantidad Disponible -->
                        <div class="mb-3">
                            <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
                            <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible"
                                required>
                        </div>

                        <!-- Campo Categoría -->
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select class="form-control @error('categoria') is-invalid @enderror" name="categoria"
                                id="categoria" required>
                                <option value="" disabled>
                                    Seleccione categoria
                                </option>
                                @foreach($categoria_inventarios as $categoria)
                                    <option value="{{ $categoria->catalogo_codigo }}" {{ old('categoria', $categoria->catalogo_codigo ?? '') == $categoria->catalogo_codigo ? 'selected' : '' }}>
                                        {{ $categoria->catalogo_descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Frecuencia Mantenimiento -->
                        <div class="mb-3">
                            <label for="frecuencia_mantenimiento" class="form-label">Frecuencia Mantenimiento</label>
                            <input type="text" class="form-control" id="frecuencia_mantenimiento"
                                name="frecuencia_mantenimiento" required>
                        </div>

                        <!-- Campo Fecha Adquisición -->
                        <div class="mb-3">
                            <label for="fecha_adquisicion" class="form-label">Fecha de Adquisición</label>
                            <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion"
                                required>
                        </div>

                        <!-- Campo Imágenes -->
                        <div class="mb-3">
                            <label for="imagenes" class="form-label">Imágenes</label>
                            <input type="file" class="form-control" id="imagenes" name="imagenes[]" multiple
                                onchange="previewImages('preloadedImages','imagenes')">
                        </div>

                        <!-- Mostrar las imágenes pre-cargadas -->
                        <div id="preloadedImages" class="d-flex flex-wrap">
                            <!-- Las imágenes pre-cargadas aparecerán aquí (puedes usar Alpine.js para esto) -->
                        </div>

                        <!-- Botón de Submit -->
                        <button type="submit" id="submitButton" class="btn btn-primary w-100">Crear Componente</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        function crear() {
            // Limpiar los campos del formulario
            document.getElementById("nombre").value = '';
            document.getElementById("descripcion").value = '';
            document.getElementById("cantidad_disponible").value = '';
            document.getElementById("categoria").value = '';
            document.getElementById("frecuencia_mantenimiento").value = '';
            document.getElementById("fecha_adquisicion").value = '';
            document.getElementById("imagenes").value = '';

            // Limpiar imágenes previas
            document.getElementById("preloadedImages").innerHTML = '';

            // Cambiar la acción del formulario a "Crear"
            document.getElementById("InventarioForm").action = '/inventarios';
            document.getElementById("formMethod").value = "POST";
            document.getElementById("submitButton").textContent = "Crear Componente";

            $('#createModal').modal('show');

        }

        function Editar(id) {
            // Obtener los datos del inventario
            fetch(`/inventarios/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Rellenar los campos del formulario con los datos obtenidos
                    document.getElementById("nombre").value = data.nombre;
                    document.getElementById("descripcion").value = data.descripcion;
                    document.getElementById("cantidad_disponible").value = data.cantidad_disponible;
                    document.getElementById("categoria").value = data.categoria;
                    document.getElementById("frecuencia_mantenimiento").value = data.frecuencia_mantenimiento;
                    document.getElementById("fecha_adquisicion").value = data.fecha_adquisicion;


                    // Cambiar la acción del formulario a "Editar"
                    document.getElementById("InventarioForm").action = `/inventarios/${id}`;
                    document.getElementById("formMethod").value = "PUT";
                    document.getElementById("submitButton").textContent = "Editar Componente";


                    $('#createModal').modal('show');
                })
                .catch(error => console.error("Error al obtener datos:", error));
        }






        function previewImages(id_preview, id_input) {
            const imageInput = document.getElementById(id_input);
            const imagePreview = document.getElementById(id_preview);
            imagePreview.innerHTML = ''; // Limpiar las imágenes previas antes de agregar las nuevas

            const files = imageInput.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // Crear un contenedor para cada imagen
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('image-container', 'position-relative', 'mr-2', 'mb-2');

                // Crear la etiqueta img
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('img-thumbnail');
                img.width = 100;  // Puedes ajustar el tamaño de la imagen

                // Crear el botón para eliminar la imagen
                const deleteBtn = document.createElement('button');
                deleteBtn.innerHTML = '&times;';
                deleteBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute', 'top-0', 'right-0', 'm-1');
                deleteBtn.onclick = function () {
                    imgContainer.remove(); // Eliminar la imagen cuando se presione la 'x'
                };

                // Agregar la imagen y el botón al contenedor
                imgContainer.appendChild(img);
                imgContainer.appendChild(deleteBtn);

                // Agregar el contenedor al área de previsualización
                imagePreview.appendChild(imgContainer);
            }
        }
        function ModalImagenes(id) {
            $('#inventario_id').val(id);

            $('#addImageModal').modal('show');

        }
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la solicitud de eliminación
                    fetch(`/inventarios/imagen/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Asegúrate de incluir el token CSRF en tu plantilla Blade
                        },
                        body: JSON.stringify({
                            id: id // El ID de la imagen a eliminar
                        })
                    })
                        .then(response => response.json())  // Esperamos la respuesta en formato JSON
                        .then(data => {
                            if (data.success) {
                                // Si la eliminación fue exitosa, mostramos un mensaje
                                Swal.fire(
                                    '¡Eliminado!',
                                    'La imagen ha sido eliminada correctamente.',
                                    'success'
                                );


                                document.getElementById(`imagen-${id}`).remove();
                            } else {
                                // Si hubo un error, mostramos un mensaje de error
                                Swal.fire(
                                    'Error!',
                                    'Hubo un problema al eliminar la imagen.',
                                    'error'
                                );
                            }
                        })


                }
            });
        }


        function EliminarInventario(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la solicitud de eliminación
                    fetch(`/inventarios/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Asegúrate de incluir el token CSRF en tu plantilla Blade
                        },
                        body: JSON.stringify({
                            id: id // El ID de la imagen a eliminar
                        })
                    })
                        .then(response => response.json())  // Esperamos la respuesta en formato JSON
                        .then(data => {
                            if (data.success) {
                                // Si la eliminación fue exitosa, mostramos un mensaje
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El componente del inventario ha sido eliminado correctamente.',
                                    'success'
                                );
                                document.getElementById(`inventario_${id}`).remove();
                            } else {
                                // Si hubo un error, mostramos un mensaje de error
                                Swal.fire(
                                    'Error!',
                                    'Hubo un problema al eliminar el componente.',
                                    'error'
                                );
                            }
                        })


                }
            });
        }
    </script>
@endsection