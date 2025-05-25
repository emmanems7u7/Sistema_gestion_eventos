@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <button class="btn btn-info" onclick="crear()"> Crear Usuario</button>
            </div>
        </div>
        <h2 class="mb-4  mt-3 position-relative">
            <span class="d-inline-block px-4 py-2 bg-dark text-white rounded-3 shadow-lg">
                <i class="fas fa-users"></i> Lista de Usuarios
            </span>

        </h2>


        <div class="table-responsive">
            <form action="{{ route('user.index') }}" method="get" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar empleado"
                        value="{{ old('search', $search) }}">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>CI</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($users as $usuario)
                        <tr id="user_{{ $usuario->id }}">
                            <td>
                                @if($usuario->imagen != null)
                                    <img src="{{ asset('storage/' . $usuario->imagen) }}" alt="Imagen"
                                        class="img-thumbnail rounded-circle" width="20" height="20">
                                @else
                                    <img src="{{ Storage::url('imagenes/perfil.png') }}" alt="Imagen de {{ $usuario->name }}"
                                        class="img-fluid rounded" width="30" height="30">
                                @endif

                            </td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->apellido_paterno }}</td>
                            <td>{{ $usuario->apellido_materno }}</td>
                            <td>{{ $usuario->ci }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                @if ($usuario->estado == 1)
                                    <span class="badge bg-danger">En Evento</span>
                                @else
                                    <span class="badge bg-success">Libre</span>
                                @endif
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary btn-sm" onclick="showUserDetails({{ $usuario->id }})"
                                        data-bs-toggle="tooltip" title="Ver"> <i class="fas fa-eye"></i></button>

                                    <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar"
                                        onclick="Editar({{ $usuario->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="Eliminar({{ $usuario->id }})"
                                        data-bs-toggle="tooltip" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Modales -->
    <!-- Modal detalles-->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="userModalLabel">Detalles del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img id="userImage" src="" class="img-fluid rounded-circle" alt="Imagen de usuario" width="150">
                        </div>
                        <div class="col-md-8">
                            <h5 id="userName" class=""></h5>
                            <p id="userBio" class="text-muted"></p>
                            <div>
                                <strong>CI:</strong> <span id="userCi"></span>
                            </div>
                            <div>
                                <strong>Dirección:</strong> <span id="userDireccion"></span>
                            </div>
                            <div>
                                <strong>Fecha de Nacimiento:</strong> <span id="userFechaNac"></span>
                            </div>
                            <div>
                                <strong>Email:</strong> <span id="userEmail"></span>
                            </div>
                            <div>
                                <strong>Estado Libre:</strong> <span id="userLibre"></span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal registro -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="createModalLabel">{{ __('Crear Nuevo Empleado') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="UserForm" action="{{ route('user.store') }}" class="p-4">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div class="modal-body">


                        <!-- Campo de Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nombre') }}</label>
                            <input id="name" name="name" type="text" class="form-control"
                                placeholder="{{ __('Ingrese el nombre') }}" required autofocus />
                            @error('name')                        <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Campo de Apellido Paterno -->
                        <div class="mb-3">
                            <label for="apellido_paterno" class="form-label">{{ __('Apellido Paterno') }}</label>
                            <input id="apellido_paterno" name="apellido_paterno" type="text" class="form-control"
                                placeholder="{{ __('Ingrese el apellido paterno') }}" required />
                            @error('apellido_paterno')                        <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Campo de Apellido Materno -->
                        <div class="mb-3">
                            <label for="apellido_materno" class="form-label">{{ __('Apellido Materno') }}</label>
                            <input id="apellido_materno" name="apellido_materno" type="text" class="form-control"
                                placeholder="{{ __('Ingrese el apellido materno') }}" required />
                            @error('apellido_materno')                        <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Campo de CI -->
                        <div class="mb-3">
                            <label for="ci" class="form-label">{{ __('CI') }}</label>
                            <input id="ci" name="ci" type="text" class="form-control"
                                placeholder="{{ __('Ingrese el CI') }}" required />
                            @error('ci')                        <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Campo de Dirección -->
                        <div class="mb-3">
                            <label for="direccion" class="form-label">{{ __('Dirección') }}</label>
                            <input id="direccion" name="direccion" type="text" class="form-control"
                                placeholder="{{ __('Ingrese la dirección') }}" required />
                            @error('direccion')                        <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Campo de Fecha de Nacimiento -->
                        <div class="mb-3">
                            <label for="fecha_nac" class="form-label">{{ __('Fecha de Nacimiento') }}</label>
                            <input id="fecha_nac" name="fecha_nac" type="date" class="form-control" required />
                            @error('fecha_nac')                        <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- Campo de Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                            <input id="email" name="email" type="email" class="form-control"
                                placeholder="{{ __('Ingrese el correo electrónico') }}" required />
                            @error('email')                        <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- Botón de Cancelar -->
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Cancelar') }}</button>

                        <!-- Botón de Crear Usuario -->
                        <button type="submit" class="btn btn-primary" id="submitButton">{{ __('Crear Usuario') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Agregar Tooltip de Bootstrap -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    <script>
        function showUserDetails(userId) {
            // Llamada a la ruta para obtener los detalles del usuario
            fetch(`/users/show/${userId}`)
                .then(response => response.json())
                .then(data => {
                    // Rellenar el modal con los datos del usuario
                    document.getElementById('userImage').src = "/storage/" + data.imagen;
                    document.getElementById('userName').textContent = `${data.name} ${data.apellido_paterno} ${data.apellido_materno}`;
                    document.getElementById('userBio').textContent = `Información adicional del usuario: ${data.name} cargo actual camarografo.`;
                    document.getElementById('userCi').textContent = data.ci;
                    document.getElementById('userDireccion').textContent = data.direccion;
                    document.getElementById('userFechaNac').textContent = data.fecha_nac;
                    document.getElementById('userEmail').textContent = data.email;
                    document.getElementById('userLibre').textContent = data.libre ? 'Sí' : 'No';

                    // Mostrar el modal
                    var myModal = new bootstrap.Modal(document.getElementById('userModal'));
                    myModal.show();
                })
                .catch(error => {
                    console.error('Error al obtener los detalles del usuario:', error);
                });
        }


        function crear() {
            document.getElementById("name").value = ''
            document.getElementById("apellido_paterno").value = '';
            document.getElementById("apellido_materno").value = '';
            document.getElementById("ci").value = '';
            document.getElementById("direccion").value = '';
            document.getElementById("fecha_nac").value = '';
            document.getElementById("email").value = '';
            document.getElementById("UserForm").action = `/users/`;
            document.getElementById("formMethod").value = "POST";
            document.getElementById("submitButton").textContent = "Crear Usuario";
            $('#createModal').modal('show');
        }
        function Editar(id) {
            fetch(`/user/${id}/edit`)
                .then(response => response.json())
                .then(data => {

                    document.getElementById("name").value = data.name;
                    document.getElementById("apellido_paterno").value = data.apellido_paterno;
                    document.getElementById("apellido_materno").value = data.apellido_materno;
                    document.getElementById("ci").value = data.ci;
                    document.getElementById("direccion").value = data.direccion;
                    document.getElementById("fecha_nac").value = data.fecha_nac;
                    document.getElementById("email").value = data.email;
                    document.getElementById("UserForm").action = `/users/${id}`;
                    document.getElementById("formMethod").value = "PUT";
                    document.getElementById("submitButton").textContent = "Editar Usuario";
                    $('#createModal').modal('show');
                })
                .catch(error => console.error("Error al obtener datos:", error));
        }

        function Eliminar(id) {
            Swal.fire({
                title: '¿Estás seguro que quieres eliminar al empleado?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la solicitud de eliminación
                    fetch(`/users/${id}`, {
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
                                    'El usuario ha sido eliminado correctamente.',
                                    'success'
                                );
                                document.getElementById(`user_${id}`).remove();
                            } else {
                                // Si hubo un error, mostramos un mensaje de error
                                Swal.fire(
                                    'Error!',
                                    'Hubo un problema al eliminar el usuario.',
                                    'error'
                                );
                            }
                        })


                }
            });
        }
    </script>

@endsection