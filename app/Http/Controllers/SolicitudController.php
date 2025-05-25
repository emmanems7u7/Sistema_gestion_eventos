<?php

namespace App\Http\Controllers;

use App\Mail\NotificarUsuarios;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\ServicioSolicitud;
use App\Models\Solicitud;
use App\Models\Evento;
use App\Models\EventoUsuario;
use App\Models\Inventario;
use App\Models\SeguimientoSolicitud;
use App\Models\Tipo_Servicio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ServicioEvento;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\SolicitudUsuario;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Mail\NotificarAprobacionAutomaticaUsuarios;
use App\Mail\NotificarAprobacionManual;
use App\Mail\NotificacionNuevaSolicitudPendiente;
use App\Mail\notificarCliente;
use Illuminate\Support\Facades\Mail;
use App\Models\ConfCorreo;
class SolicitudController extends Controller
{
    // Mostrar el listado de solicitudes
    public function index(Request $request)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Solicitudes', 'url' => route('solicitudes.index')],
        ];
        $query = Solicitud::with('seguimientos');

        if ($request->filled('buscar')) {
            $query->where('titulo', 'like', '%' . $request->buscar . '%');
        }
        if ($request->filled('estado_aprobacion')) {
            $query->where('estado_aprobacion', $request->estado_aprobacion);
        }

        $solicitudes = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('solicitudes.index', compact('solicitudes', 'breadcrumb'));
    }

    // Mostrar el formulario para crear una nueva solicitud
    public function create()
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Solicitudes', 'url' => route('solicitudes.index')],
            ['name' => 'Crear', 'url' => route('solicitudes.create')],

        ];
        $servicios = Servicio::all();

        return view('solicitudes.create', compact('breadcrumb', 'servicios'));
    }

    public function crear_solicitud()
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Solicitudes', 'url' => route('solicitudes.index')],
            ['name' => 'Crear', 'url' => route('solicitudes.create')],

        ];
        $servicios = Servicio::all();

        return view('solicitudes.solicitud_cliente', compact('breadcrumb', 'servicios'));
    }
    // Guardar la solicitud en la base de datos
    public function store(Request $request)
    {

        $conf = ConfCorreo::first();

        if ($conf) {
            config([
                'mail.mailers.smtp.host' => $conf->conf_smtp_host,
                'mail.mailers.smtp.port' => $conf->conf_smtp_port,
                'mail.mailers.smtp.username' => $conf->conf_smtp_user,
                'mail.mailers.smtp.password' => $conf->conf_smtp_pass,
                'mail.mailers.smtp.encryption' => $conf->conf_protocol,
                'mail.default' => 'smtp',
            ]);
        }

        //  dd($request);
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i|before:hora_fin',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'nullable|string|max:255',
            'geolocalizacion' => ['nullable', 'string', 'max:255', 'not_in:undefined'],
            'estado' => 'required|boolean',
            //datos del cliente
            'nombre' => 'required|string|max:255',
            'ape_pat' => 'required|string|max:255',
            'ape_mat' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'nullable|string|max:20',

        ]);

        $serviciosSeleccionados = json_decode($request->input('servicios_seleccionados'), true);

        $solicitud = Solicitud::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'] ?? null,
            'fecha' => $validated['fecha'],
            'hora_inicio' => $validated['hora_inicio'],
            'hora_fin' => $validated['hora_fin'],
            'ubicacion' => $validated['ubicacion'] ?? null,
            'geolocalizacion' => $validated['geolocalizacion'] ?? null,
            'estado' => $validated['estado'],
            'estado_aprobacion' => 1
        ]);

        $cliente = Cliente::create([
            'nombre' => $request->input('nombre'),
            'ape_pat' => $request->input('ape_pat'),
            'ape_mat' => $request->input('ape_mat'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'solicitud_id' => $solicitud->id,
        ]);

        foreach ($serviciosSeleccionados as $servicioId => $planId) {

            ServicioSolicitud::create([
                'solicitud_id' => $solicitud->id,
                'servicio_id' => $servicioId,
                'tipo_servicio_id' => $planId,
            ]);
        }
        $data = $this->validar_servicios($solicitud);

        $fechaActual = Carbon::now()->startOfDay()->toDateString();
        $horaActual = Carbon::now()->format('H:i');
        $admins = User::role('admin')->get();
        if ($data['status'] == 1) {
            $aprobado = 1;
            $this->aprobar($solicitud, 2, $aprobado);

            $seguimiento = SeguimientoSolicitud::create([
                'solicitud_id' => $solicitud->id,
                'mensaje' => "La solicitud fue aprobada automaticamente en fecha" . $fechaActual . " a horas " . $horaActual . " se informó al cliente mediante correo",
            ]);

            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NotificarAprobacionAutomaticaUsuarios($solicitud));
            }

        } else {
            $seguimiento = SeguimientoSolicitud::create([
                'solicitud_id' => $solicitud->id,
                'mensaje' => $data['mensaje'],
            ]);
            return redirect()->route('solicitudes.index')->with('success', 'La solicitud no fue aprobada automaticamente puede revisar el registro para ver los detalles');

        }

        return redirect()->route('eventos.index')->with('success', 'Solicitud aprobada automaticamente con éxito');
    }
    public function store_cliente(Request $request)
    {

        $conf = ConfCorreo::first();

        if ($conf) {
            config([
                'mail.mailers.smtp.host' => $conf->conf_smtp_host,
                'mail.mailers.smtp.port' => $conf->conf_smtp_port,
                'mail.mailers.smtp.username' => $conf->conf_smtp_user,
                'mail.mailers.smtp.password' => $conf->conf_smtp_pass,
                'mail.mailers.smtp.encryption' => $conf->conf_protocol,
                'mail.default' => 'smtp',
            ]);
        }

        //  dd($request);
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i|before:hora_fin',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'nullable|string|max:255',
            'geolocalizacion' => ['nullable', 'string', 'max:255', 'not_in:undefined'],
            //datos del cliente
            'nombre' => 'required|string|max:255',
            'ape_pat' => 'required|string|max:255',
            'ape_mat' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefono' => 'nullable|string|max:20',

        ]);

        $serviciosSeleccionados = json_decode($request->input('servicios_seleccionados'), true);

        $solicitud = Solicitud::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'] ?? null,
            'fecha' => $validated['fecha'],
            'hora_inicio' => $validated['hora_inicio'],
            'hora_fin' => $validated['hora_fin'],
            'ubicacion' => $validated['ubicacion'] ?? null,
            'geolocalizacion' => $validated['geolocalizacion'] ?? null,
            'estado' => 1,
            'estado_aprobacion' => 1
        ]);

        $cliente = Cliente::create([
            'nombre' => $request->input('nombre'),
            'ape_pat' => $request->input('ape_pat'),
            'ape_mat' => $request->input('ape_mat'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'solicitud_id' => $solicitud->id,
        ]);

        foreach ($serviciosSeleccionados as $servicioId => $planId) {

            ServicioSolicitud::create([
                'solicitud_id' => $solicitud->id,
                'servicio_id' => $servicioId,
                'tipo_servicio_id' => $planId,
            ]);
        }
        $data = $this->validar_servicios($solicitud);

        $fechaActual = Carbon::now()->startOfDay()->toDateString();
        $horaActual = Carbon::now()->format('H:i');
        $admins = User::role('admin')->get();
        if ($data['status'] == 1) {
            $aprobado = 1;
            $this->aprobar($solicitud, 2, $aprobado);

            $seguimiento = SeguimientoSolicitud::create([
                'solicitud_id' => $solicitud->id,
                'mensaje' => "La solicitud fue aprobada automaticamente en fecha" . $fechaActual . " a horas " . $horaActual . " se informó al cliente mediante correo",
            ]);

            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NotificarAprobacionAutomaticaUsuarios($solicitud));
            }

        } else {
            $seguimiento = SeguimientoSolicitud::create([
                'solicitud_id' => $solicitud->id,
                'mensaje' => $data['mensaje'],
            ]);

            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NotificacionNuevaSolicitudPendiente($solicitud));
            }
            return redirect()->back()->with('success', 'La solicitud creada exitosamente');

        }

        return redirect()->back()->with('success', 'Solicitud aprobada automaticamente con éxito,revise su bandeja de mensajes de email');
    }
    // Mostrar los detalles de una solicitud
    public function show(Solicitud $solicitud)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Solicitudes', 'url' => route('solicitudes.index')],
            ['name' => 'Aprobar', 'url' => route('solicitudes.show', $solicitud)],
        ];

        $tipo_servicios = ServicioSolicitud::where('solicitud_id', $solicitud->id)->get()->map(function ($item) {
            return [
                'servicio_id' => $item->servicio_id,
                'nombre_servicio' => Servicio::find($item->servicio_id)->nombre,
                'tipo_servicio_id' => $item->tipo_servicio_id,
                'nombre_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->tipo,
                'caracteristicas_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->caracteristicas,
                'precio_tipo_Servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->precio,
            ];
        });

        $total = $this->calcularTotal($solicitud);
        $data = $this->validar_servicios($solicitud);

        return view('solicitudes.show', compact('data', 'solicitud', 'breadcrumb', 'tipo_servicios', 'total'));
    }

    private function calcularTotal(Solicitud $solicitud): float
    {
        $horaInicio = Carbon::parse($solicitud->hora_inicio);
        $horaFin = Carbon::parse($solicitud->hora_fin);
        $duracionHoras = $horaInicio->diffInHours($horaFin);

        $tipo_servicios = ServicioSolicitud::where('solicitud_id', $solicitud->id)->get()->map(function ($item) {
            return [
                'servicio_id' => $item->servicio_id,
                'nombre_servicio' => Servicio::find($item->servicio_id)->nombre,
                'tipo_servicio_id' => $item->tipo_servicio_id,
                'nombre_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->tipo,
                'caracteristicas_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->caracteristicas,
                'precio_tipo_Servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->precio,
            ];
        });

        $total = 0;
        foreach ($tipo_servicios as $tipo) {
            $precio = $tipo['precio_tipo_Servicio'] ?? 0;
            $total += $precio * $duracionHoras;
        }

        return round($total, 1);
    }
    function validar_servicios($solicitud)
    {
        $tipo_servicios = ServicioSolicitud::where('solicitud_id', $solicitud->id)->get();
        $mensajes_ok = '';
        $mensajes_error = '';
        $status = 1;
        if (!$tipo_servicios->isEmpty()) {
            foreach ($tipo_servicios as $plan) {
                $servicio = Servicio::find($plan->servicio_id);
                $tipo_servicio = Tipo_Servicio::find($plan->tipo_servicio_id);
                $role = Role::find($servicio->role_id);
                $personal = $role ? User::role($role->name)->get() : collect();

                // Validar personal
                [$ok_personal, $mensaje_personal] = $this->validar_personal_disponible($personal, $tipo_servicio, $solicitud, $servicio->nombre);
                if ($ok_personal) {
                    $mensajes_ok .= $mensaje_personal;
                } else {
                    $mensajes_error .= $mensaje_personal;

                    $status = 0;
                }

                // Validar equipo
                [$ok_equipo, $mensaje_equipo] = $this->validar_equipo_disponible($tipo_servicio, $servicio->nombre);
                if ($ok_equipo) {
                    $mensajes_ok .= $mensaje_equipo;
                } else {
                    $mensajes_error .= $mensaje_equipo;

                    $status = 0;
                }
            }
        } else {
            $mensajes_error .= '<li>No se han seleccionado servicios para la solicitud.</li>';
            $status = 0;
        }


        $mensaje = '';
        if (!empty($mensajes_error))
            $mensaje .= '<ul>' . $mensajes_error . '</ul>';
        if (!empty($mensajes_ok))
            $mensaje .= '<ul>' . $mensajes_ok . '</ul>';

        return [
            'status' => $status,
            'mensaje' => $mensaje,
        ];
    }

    // ------------------- Funciones para validar  -------------------

    function validar_personal_disponible($personal, $tipo_servicio, $solicitud, $nombre_servicio)
    {
        if ($tipo_servicio->cantidad_personal <= 0) {
            return [true, '<li>El servicio <strong>' . $nombre_servicio . '</strong> no requiere personal asignado.</li>'];
        }

        $personal_disponible = $personal->filter(function ($usuario) use ($solicitud) {
            return !EventoUsuario::where('user_id', $usuario->id)
                ->where('fecha', $solicitud->fecha)
                ->where(function ($query) use ($solicitud) {
                    $query->where('hora_inicio', '<', $solicitud->hora_fin)
                        ->where('hora_fin', '>', $solicitud->hora_inicio);
                })->exists();
        });

        $disponibles = $personal_disponible->count();
        $requeridos = $tipo_servicio->cantidad_personal;

        if ($disponibles >= $requeridos) {
            return [true, '<li>Para el servicio <strong>' . $nombre_servicio . '</strong>, hay suficiente personal disponible. (' . $disponibles . ' Disponibles)</li>'];
        } else {
            return [false, '<li>El servicio <strong>' . $nombre_servicio . '</strong> necesita ' . $requeridos . ' personas disponibles en el horario (' . $solicitud->hora_inicio . ' a ' . $solicitud->hora_fin . '), pero solo hay ' . $disponibles . ' disponibles.</li>'];
        }
    }

    function validar_equipo_disponible($tipo_servicio, $nombre_servicio)
    {
        if ($tipo_servicio->cantidad_equipo <= 0) {
            return [true, '<li>El servicio <strong>' . $nombre_servicio . '</strong> no requiere equipo específico.</li>'];
        }

        $equipo = Inventario::find($tipo_servicio->inventario_id);

        if ($equipo && $equipo->cantidad_disponible >= $tipo_servicio->cantidad_equipo) {
            return [true, '<li>El equipo necesario para el servicio <strong>' . $nombre_servicio . '</strong> está disponible.</li>'];
        } else {
            $requerido = $tipo_servicio->cantidad_equipo;
            $disponible = $equipo ? $equipo->cantidad_disponible : 0;
            return [false, '<li>Falta equipo para el servicio <strong>' . $nombre_servicio . '</strong>. Se requieren ' . $requerido . ' unidades, pero solo hay ' . $disponible . ' disponibles.</li>'];
        }
    }

    // Mostrar el formulario para editar una solicitud
    public function edit(Solicitud $solicitud)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Solicitudes', 'url' => route('solicitudes.index')],
            ['name' => 'Editar', 'url' => route('solicitudes.edit', $solicitud)],

        ];
        $servicios = Servicio::all();
        $tipo_servicios = ServicioSolicitud::where('solicitud_id', $solicitud->id)->get();
        $cliente = Cliente::where('solicitud_id', $solicitud->id)->first();
        return view('solicitudes.edit', compact('cliente', 'solicitud', 'breadcrumb', 'servicios'));
    }

    public function aprobar(Solicitud $solicitud, $tipo = 3, $aprobado = 0)
    {
        if ($solicitud->estado_aprobacion != 1) {
            return redirect()->back()->with('error', 'La solicitud ya fue aprobada');
        }
        $tipo_servicios = ServicioSolicitud::where('solicitud_id', $solicitud->id)->get();
        $data = $this->validar_servicios($solicitud);

        if ($data['status'] == 1) {

            $evento = Evento::Create([
                'titulo' => $solicitud->titulo,
                'descripcion' => $solicitud->descripcion,
                'fecha' => $solicitud->fecha,
                'hora_inicio' => $solicitud->hora_inicio,
                'hora_fin' => $solicitud->hora_fin,
                'ubicacion' => $solicitud->ubicacion,
                'geolocalizacion' => $solicitud->geolocalizacion,
                'estado' => 1,
                'estado_aprobacion' => $tipo
            ]);
            $cliente = Cliente::where('solicitud_id', $solicitud->id)->first();
            $cliente->evento_id = $evento->id;
            $cliente->save();

            foreach ($tipo_servicios as $plan) {

                $servicio_evento = ServicioEvento::create([
                    'servicio_id' => $plan->servicio_id,
                    'evento_id' => $evento->id,
                    'tipo_servicio_id' => $plan->tipo_servicio_id,
                ]);

                $servicio = Servicio::find($plan->servicio_id);
                $role = Role::find($servicio->role_id);
                $personal = $role ? User::role($role->name)->get() : collect();

                $tipo_servicio = Tipo_Servicio::find($plan->tipo_servicio_id);

                // Filtrar personal disponible en base a la fecha y horas de la solicitud
                $personal_disponible = $personal->filter(function ($usuario) use ($solicitud) {
                    return !EventoUsuario::where('user_id', $usuario->id)
                        ->where('fecha', $solicitud->fecha)
                        ->where(function ($query) use ($solicitud) {
                            $query->where('hora_inicio', '<', $solicitud->hora_fin)
                                ->where('hora_fin', '>', $solicitud->hora_inicio);
                        })->exists();
                });

                // Asignar a los primeros N disponibles
                foreach ($personal_disponible->take($tipo_servicio->cantidad_personal) as $usuario) {
                    EventoUsuario::create([
                        'evento_id' => $evento->id,
                        'user_id' => $usuario->id,
                        'fecha' => $solicitud->fecha,
                        'hora_inicio' => $solicitud->hora_inicio,
                        'hora_fin' => $solicitud->hora_fin,
                    ]);

                    $usuario = User::find($usuario->id);
                    Mail::to($usuario->email)->send(new NotificarUsuarios($evento));

                }

            }
            $solicitud->estado_aprobacion = $tipo;
            $solicitud->save();

            if ($aprobado == 0) {

                $fechaActual = Carbon::now()->startOfDay()->toDateString();
                $horaActual = Carbon::now()->format('H:i');
                $admins = User::role('admin')->get();

                $seguimiento = SeguimientoSolicitud::create([
                    'solicitud_id' => $solicitud->id,
                    'mensaje' => "La solicitud fue aprobada de forma manual en fecha" . $fechaActual . " a horas " . $horaActual . " se informó al cliente mediante correo",
                ]);

                $cliente = Cliente::where('solicitud_id', $solicitud->id)->first();
                Mail::to($cliente->email)->send(new notificarCliente($evento));

                foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NotificarAprobacionManual($solicitud));
                }

            }
        } else {

            return redirect()->back()->with('error', 'La solicitud no puede ser aprobada, ya que no hay suficiente personal o equipo disponible para el servicio solicitado. <br> ' . $data['mensaje']);

        }

        return redirect()->back()->with('success', 'La solicitud fue aprobada con exito');

    }

    // Actualizar una solicitud en la base de datos
    public function update(Request $request, Solicitud $solicitud)
    {


        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i|before:hora_fin',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'nullable|string|max:255',
            'geolocalizacion' => ['nullable', 'string', 'max:255', 'not_in:undefined'],
            'estado' => 'required|boolean'
        ]);



        $solicitud->update($validated);

        $serviciosSeleccionados = json_decode($request->input('servicios_seleccionados'), true);

        $cliente = Cliente::where('solicitud_id', $solicitud->id)->first();

        $rules = [
            'nombre' => 'required|string|max:255',
            'ape_pat' => 'required|string|max:255',
            'ape_mat' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ];
        if ($cliente) {
            $rules['email'] = 'required|email|unique:clientes,email,' . $cliente->id;
        } else {

            $rules['email'] = 'required|email|unique:clientes,email';
        }

        $request->validate($rules);
        $cliente = Cliente::updateOrCreate(
            ['solicitud_id' => $solicitud->id], // Criterio de búsqueda
            [
                'email' => $request->input('email'),
                'nombre' => $request->input('nombre'),
                'ape_pat' => $request->input('ape_pat'),
                'ape_mat' => $request->input('ape_mat'),
                'telefono' => $request->input('telefono'),
                'solicitud_id' => $solicitud->id,
            ]
        );

        ServicioSolicitud::where('solicitud_id', $solicitud->id)->delete();


        foreach ($serviciosSeleccionados as $servicioId => $planId) {

            if ($servicioId && $planId) {
                ServicioSolicitud::create([
                    'solicitud_id' => $solicitud->id,
                    'servicio_id' => $servicioId,
                    'tipo_servicio_id' => $planId,
                ]);
            }
        }

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada con éxito');
    }

    // Eliminar una solicitud de la base de datos
    public function destroy(Solicitud $solicitud)
    {
        $solicitud->delete();

        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada con éxito');
    }

    function validarSolicitud(Request $request)
    {
        try {
            $validated = $request->validate([
                'fecha' => 'required|date',
                'hora_inicio' => 'required|date_format:H:i|before:hora_fin',
                'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw new HttpResponseException(response()->json([
                'status' => 3,
                'errors' => $e->errors()
            ], 422));
        }

        $serviciosSeleccionados = json_decode($request->input('servicios_seleccionados'), true);

        $solicitud = Solicitud::create([
            'titulo' => 'temporal',
            'descripcion' => 'temporal',
            'fecha' => $validated['fecha'],
            'hora_inicio' => $validated['hora_inicio'],
            'hora_fin' => $validated['hora_fin'],
            'ubicacion' => 'temporal',
            'geolocalizacion' => '0,0',
            'estado' => 1,
            'estado_aprobacion' => 1
        ]);


        foreach ($serviciosSeleccionados as $servicioId => $planId) {

            ServicioSolicitud::create([
                'solicitud_id' => $solicitud->id,
                'servicio_id' => $servicioId,
                'tipo_servicio_id' => $planId,
            ]);
        }
        $data = $this->validar_servicios($solicitud);


        if ($data['status'] == 1) {
            $total = $this->calcularTotal($solicitud);

            $response = [
                'status' => 1,
                'mensaje' => '<br>' . $data['mensaje'] . '<br> El monto a cobrar por la solicitud es: Bs.' . $total,
                'total' => $total,
            ];
        } else {
            $response = [
                'status' => 0,
                'mensaje' => 'La solicitud no puede ser aprobada porque no cumple con los requisitos: <br>' . $data['mensaje'],
                'total' => '',
            ];
        }

        $servicios_temp = ServicioSolicitud::where('solicitud_id', $solicitud->id)->get();
        $servicios_temp->each(function ($servicio) {
            $servicio->delete();
        });
        $solicitud->delete();

        return response()->json($response);
    }


    function verifica_precios(Request $request)
    {
        try {
            $validated = $request->validate([
                'fecha' => 'required|date',
                'hora_inicio' => 'required|date_format:H:i|before:hora_fin',
                'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw new HttpResponseException(response()->json([
                'status' => 3,
                'errors' => $e->errors()
            ], 422));
        }

        $serviciosSeleccionados = json_decode($request->input('servicios_seleccionados'), true);

        $solicitud = Solicitud::create([
            'titulo' => 'temporal',
            'descripcion' => 'temporal',
            'fecha' => $validated['fecha'],
            'hora_inicio' => $validated['hora_inicio'],
            'hora_fin' => $validated['hora_fin'],
            'ubicacion' => 'temporal',
            'geolocalizacion' => '0,0',
            'estado' => 1,
            'estado_aprobacion' => 1
        ]);


        foreach ($serviciosSeleccionados as $servicioId => $planId) {

            ServicioSolicitud::create([
                'solicitud_id' => $solicitud->id,
                'servicio_id' => $servicioId,
                'tipo_servicio_id' => $planId,
            ]);
        }



        $total = $this->calcularTotal($solicitud);


        $servicios_temp = ServicioSolicitud::where('solicitud_id', $solicitud->id)->get();
        $servicios_temp->each(function ($servicio) {
            $servicio->delete();
        });
        $solicitud->delete();

        return response()->json(['status' => 1, 'total' => $total]);
    }
    function detalle_solicitud(Solicitud $solicitud)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Solicitudes', 'url' => route('solicitudes.index')],
            ['name' => 'Detalle', 'url' => route('solicitudes.index', $solicitud)],
        ];
        $tipo_servicios = ServicioSolicitud::where('solicitud_id', $solicitud->id)->get()->map(function ($item) {
            return [
                'servicio_id' => $item->servicio_id,
                'nombre_servicio' => Servicio::find($item->servicio_id)->nombre,
                'tipo_servicio_id' => $item->tipo_servicio_id,
                'nombre_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->tipo,
                'caracteristicas_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->caracteristicas,
                'precio_tipo_Servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->precio,
            ];
        });
        $data = $this->validar_servicios($solicitud);
        $total = $this->calcularTotal($solicitud);
        $cliente = Cliente::where('solicitud_id', $solicitud->id)->first();
        return view('solicitudes.detalle', compact('solicitud', 'tipo_servicios', 'total', 'data', 'breadcrumb', 'cliente'));
    }
}
