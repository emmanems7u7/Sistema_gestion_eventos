<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ConfCorreoController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CategoriaController;

use App\Http\Controllers\InventarioController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\EventoController;

use App\Http\Controllers\ServicioController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'welcome'])->name('inicio');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//usuarios

Route::middleware(['auth', 'can:Administración de Usuarios'])->group(function () {

    Route::get('/usuarios', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('can:Usuarios');

    Route::get('/usuarios/crear', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('can:usuarios.crear');

    Route::post('/usuarios', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware('can:usuarios.crear');

    Route::get('/usuarios/{user}', [UserController::class, 'show'])
        ->name('users.show')
        ->middleware('can:usuarios.ver');

    Route::get('/usuarios/edit/{id}', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('can:usuarios.editar');

    Route::put('/usuarios/{id}/{perfil}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('can:usuarios.editar');

    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('can:usuarios.eliminar');

    Route::get('/datos/usuario/{id}', [UserController::class, 'GetUsuario'])
        ->name('users.get')
        ->middleware('can:usuarios.ver');


});



//Rutas para secciones
Route::resource('secciones', SeccionController::class)->except([
    'show',
])->middleware(['auth', 'role:admin']);

//Rutas para Menus
Route::resource('menus', MenuController::class)->except([
    'show',
])->middleware(['auth', 'role:admin']);


// Rutas para la configuracion de correo

Route::middleware(['auth', 'can:Configuración'])->group(function () {

    Route::get('/configuracion/correo', [ConfCorreoController::class, 'index'])
        ->name('configuracion.correo.index')
        ->middleware('can:configuracion_correo.ver');

    Route::post('/configuracion/correo/guardar', [ConfCorreoController::class, 'store'])
        ->name('configuracion.correo.store')
        ->middleware('can:configuracion_correo.actualizar');

    Route::get('/correo/prueba', [ConfCorreoController::class, 'enviarPrueba'])
        ->name('correo.prueba')
        ->middleware('can:configuracion.correo');

    Route::get('/correos/plantillas', [CorreoController::class, 'index'])
        ->name('correos.index')
        ->middleware('can:plantillas.ver');

    Route::put('/editar/plantilla/{id}', [CorreoController::class, 'update_plantilla'])
        ->name('plantilla.update')
        ->middleware('can:plantillas.actualizar');

    Route::get('/obtener/plantilla/{id}', [CorreoController::class, 'GetPlantilla'])
        ->name('obtener.correo');

});

//cambio de contraseña
Route::middleware(['auth'])->group(function () {

    Route::get('/usuario/contraseña', [PasswordController::class, 'ActualizarContraseña'])->name('user.actualizar.contraseña');
    Route::put('password/update', [PasswordController::class, 'update'])->name('password.actualizar');

    Route::get('/usuario/perfil', [UserController::class, 'Perfil'])
        ->name('perfil');
});



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/roles', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware('can:roles.inicio');

    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('roles.create')
        ->middleware('can:roles.crear');

    Route::post('/roles', [RoleController::class, 'store'])
        ->name('roles.store')
        ->middleware('can:roles.guardar');

    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])
        ->name('roles.edit')
        ->middleware('can:roles.editar');

    Route::put('/roles/{id}', [RoleController::class, 'update'])
        ->name('roles.update')
        ->middleware('can:roles.actualizar');

    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])
        ->name('roles.destroy')
        ->middleware('can:roles.eliminar');

    Route::get('/permissions', [PermissionController::class, 'index'])
        ->name('permissions.index')
        ->middleware('can:permisos.inicio');

    Route::get('/permissions/create', [PermissionController::class, 'create'])
        ->name('permissions.create')
        ->middleware('can:permisos.crear');

    Route::post('/permissions', [PermissionController::class, 'store'])
        ->name('permissions.store')
        ->middleware('can:permisos.guardar');

    Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])
        ->name('permissions.edit')
        ->middleware('can:permisos.editar');

    Route::put('/permissions/{id}', [PermissionController::class, 'update'])
        ->name('permissions.update')
        ->middleware('can:permisos.actualizar');

    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])
        ->name('permissions.destroy')
        ->middleware('can:permisos.eliminar');

    Route::get('/permissions/cargar/menu/{id}/{rol_id}', [RoleController::class, 'get_permisos_menu'])
        ->name('permissions.menu');

});




//Rutas configuracion general

Route::middleware(['auth', 'role:admin', 'can:Configuración General'])->group(function () {

    Route::get('/admin/configuracion', [ConfiguracionController::class, 'edit'])
        ->name('admin.configuracion.edit')
        ->middleware('can:configuracion.inicio');

    Route::put('/admin/configuracion', [ConfiguracionController::class, 'update'])
        ->name('admin.configuracion.update')
        ->middleware('can:configuracion.actualizar');

});


//doble factor de autenticacion
Route::get('/2fa/verify', [TwoFactorController::class, 'index'])->name('verify.index');
Route::post('/2fa/verify', [TwoFactorController::class, 'store'])->name('verify.store');
Route::post('/2fa/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');

//Catalogo


Route::middleware(['auth', 'role:admin', 'can:Configuración General'])->group(function () {


});
Route::middleware(['auth', 'can:Administración y Parametrización'])->group(function () {

    // Rutas para catalogos
    Route::get('/catalogos', [CatalogoController::class, 'index'])->name('catalogos.index')->middleware('can:catalogo.ver');
    Route::get('/catalogos/create', [CatalogoController::class, 'create'])->name('catalogos.create')->middleware('can:catalogo.crear');
    Route::post('/catalogos', [CatalogoController::class, 'store'])->name('catalogos.store')->middleware('can:catalogo.guardar');
    Route::get('/catalogos/{id}', [CatalogoController::class, 'show'])->name('catalogos.show')->middleware('can:catalogo.ver_detalle');
    Route::get('/catalogos/{id}/edit', [CatalogoController::class, 'edit'])->name('catalogos.edit')->middleware('can:catalogo.editar');
    Route::put('/catalogos/{id}', [CatalogoController::class, 'update'])->name('catalogos.update')->middleware('can:catalogo.actualizar');
    Route::delete('/catalogos/{id}', [CatalogoController::class, 'destroy'])->name('catalogos.destroy')->middleware('can:catalogo.eliminar');

    // Rutas para categorias
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index')->middleware('can:categoria.ver');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create')->middleware('can:categoria.crear');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store')->middleware('can:categoria.guardar');
    Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categorias.show')->middleware('can:categoria.ver_detalle');
    Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit')->middleware('can:categoria.editar');
    Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update')->middleware('can:categoria.actualizar');
    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy')->middleware('can:categoria.eliminar');
});


//Rutas Negocio


// Ruta para mostrar la lista de inventarios con búsqueda y paginación
Route::get('/inventarios', [InventarioController::class, 'index'])->name('inventarios.index')->middleware('can:inventarios.ver');

// Ruta para mostrar el formulario de creación de inventario
Route::get('/inventarios/create', [InventarioController::class, 'create'])->name('inventarios.create')->middleware('can:inventarios.crear');

// Ruta para almacenar un nuevo inventario
Route::post('/inventarios', [InventarioController::class, 'store'])->name('inventarios.store')->middleware('can:inventarios.guardar');

// Ruta para mostrar el formulario de edición de inventario
Route::get('/inventarios/{id}/edit', [InventarioController::class, 'edit'])->name('inventarios.edit')->middleware('can:inventarios.editar');

// Ruta para actualizar un inventario
Route::put('/inventarios/{id}', [InventarioController::class, 'update'])->name('inventarios.update')->middleware('can:inventarios.actualizar');

// Ruta para eliminar un inventario
Route::delete('/inventarios/{id}', [InventarioController::class, 'destroy'])->name('inventarios.destroy')->middleware('can:inventarios.eliminar');

// Ruta para subir imagen
Route::post('/inventarios/agregar-imagen', [InventarioController::class, 'agregarImagen'])->name('inventarios.agregarImagen')->middleware('can:inventarios.agregar_imagen');

// Ruta para eliminar imagen
Route::delete('/inventarios/imagen/{id}', [InventarioController::class, 'eliminarImagen'])->name('inventarios.eliminarImagen')->middleware('can:inventarios.eliminar_imagen');





// Listar todas las solicitudes
Route::middleware(['auth'])->group(function () {

    Route::get('solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index')->middleware('can:solicitudes.ver');
    Route::get('solicitudes/aprobados', [SolicitudController::class, 'index_aprobados'])->name('solicitudes_aprobados.index')->middleware('can:solicitudes.ver_aprobados');
    Route::get('solicitudes/create', [SolicitudController::class, 'create'])->name('solicitudes.create')->middleware('can:solicitudes.crear');
    Route::post('solicitudes', [SolicitudController::class, 'store'])->name('solicitudes.store')->middleware('can:solicitudes.guardar');
    Route::get('solicitudes/{solicitud}', [SolicitudController::class, 'show'])->name('solicitudes.show')->middleware('can:solicitudes.ver_aprobacion');
    Route::get('solicitudes/{solicitud}/edit', [SolicitudController::class, 'edit'])->name('solicitudes.edit')->middleware('can:solicitudes.editar');
    Route::put('solicitudes/{solicitud}', [SolicitudController::class, 'update'])->name('solicitudes.update')->middleware('can:solicitudes.actualizar');
    Route::delete('solicitudes/{solicitud}', [SolicitudController::class, 'destroy'])->name('solicitudes.destroy')->middleware('can:solicitudes.eliminar');
    Route::post('/solicitudes/{solicitud}/aprobar', [SolicitudController::class, 'aprobar'])->name('solicitudes.aprobar')->middleware('can:solicitudes.aprobar');
    Route::post('/solicitudes/{solicitud}/rechazar', [SolicitudController::class, 'rechazar'])->name('solicitudes.rechazar')->middleware('can:solicitudes.rechazar');
    Route::post('/validar/solicitud', [SolicitudController::class, 'validarSolicitud'])->name('validar.solicitud')->middleware('can:solicitudes.validar');
    Route::get('/detalle/solicitud/{solicitud}', [SolicitudController::class, 'detalle_solicitud'])->name('solicitud.detalle')->middleware('can:solicitudes.detalle');


});
Route::get('solicitud/cliente', [SolicitudController::class, 'crear_solicitud'])->name('solicitud.evento_cliente');
Route::post('solicitudes/cliente', [SolicitudController::class, 'store_cliente'])->name('solicitudes.store_cliente');

Route::post('/precio/solicitud', [SolicitudController::class, 'verifica_precios']);



// Listar todas las eventos

Route::get('eventos', [EventoController::class, 'index'])->name('eventos.index')->middleware('can:eventos.ver');


Route::get('eventos/create', [EventoController::class, 'create'])->name('eventos.create')->middleware('can:eventos.crear');
Route::post('eventos', [EventoController::class, 'store'])->name('eventos.store')->middleware('can:eventos.guardar');
Route::get('eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show')->middleware('can:eventos.ver_detalle');
Route::get('eventos/{evento}/edit', [EventoController::class, 'edit'])->name('eventos.edit')->middleware('can:eventos.editar');
Route::put('eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update')->middleware('can:eventos.actualizar');
Route::delete('eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy')->middleware('can:eventos.eliminar');

Route::get('eventos/{evento}/recibo', [EventoController::class, 'recibo'])->name('eventos.recibo');
Route::get('eventos/{evento}/{cliente}/email', [EventoController::class, 'email'])->name('eventos.email')->middleware('can:eventos.email');



Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index')->middleware('can:servicios.ver');
Route::get('/servicios/create', [ServicioController::class, 'create'])->name('servicios.create')->middleware('can:servicios.crear');
Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store')->middleware('can:servicios.guardar');
Route::get('/servicios/{servicio}/edit', [ServicioController::class, 'edit'])->name('servicios.edit')->middleware('can:servicios.editar');
Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update')->middleware('can:servicios.actualizar');
Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy')->middleware('can:servicios.eliminar');
Route::put('/servicios/componentes/{servicio}', [ServicioController::class, 'componentes'])->name('servicios.componentes')->middleware('can:servicios.agregar_componentes');




Route::get('tipo_servicios/create/{servicio}', [servicioController::class, 'create_tipo_servicio'])->name('tipo_servicios.create')->middleware('can:servicios.crear_tipo_servicio');
Route::post('tipo_servicios', [servicioController::class, 'store_tipo_servicio'])->name('tipo_servicios.store')->middleware('can:servicios.guardar_tipo_servicio');
Route::get('tipo_servicios/{id}/edit', [servicioController::class, 'edit_tipo_servicio'])->name('tipo_servicios.edit')->middleware('can:servicios.editar_tipo_servicio');
Route::put('tipo_servicios/{id}', [servicioController::class, 'update_tipo_servicio'])->name('tipo_servicios.update')->middleware('can:servicios.actualizar_tipo_servicio');
Route::delete('tipo_servicios/{id}', [servicioController::class, 'destroy_tipo_servicio'])->name('tipo_servicios.destroy')->middleware('can:servicios.eliminar_tipo_servicio');

Route::get('/tipos/por-servicio/{id}', [servicioController::class, 'porServicio']);

Route::get('/subcategorias/por-categoria/{id}', function ($id) {
    return App\Models\Catalogo::where('categoria_id', $id)->get();
});

Route::post('/api/sugerir-icono', [SeccionController::class, 'SugerirIcono']);