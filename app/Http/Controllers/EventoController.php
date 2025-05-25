<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Cliente;
use App\Models\EventoUsuario;
use App\Models\Servicio;
use App\Models\ServicioEvento;
use App\Models\Tipo_Servicio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use PDF;
use App\Mail\notificarCliente;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Mail;
class EventoController extends Controller
{
    // Mostrar el listado de solicitudess
    public function index(Request $request)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Eventos', 'url' => route('eventos.index')],
        ];
        $query = Evento::query();

        if ($request->filled('buscar')) {
            $query->where('titulo', 'like', '%' . $request->buscar . '%');
        }
        if ($request->filled('estado_aprobacion')) {
            $query->where('estado_aprobacion', $request->estado_aprobacion);
        }

        $eventos = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('eventos.index', compact('eventos', 'breadcrumb'));
    }

    // Mostrar el formulario para crear una nueva solicitud
    public function create()
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Eventos', 'url' => route('eventos.index')],
            ['name' => 'Crear', 'url' => route('eventos.create')],

        ];
        return view('eventos.create', compact('breadcrumb'));
    }

    // Guardar la solicitud en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'ubicacion' => 'nullable|string|max:255',
            'geolocalizacion' => 'nullable|string|max:255',
            'estado' => 'required|boolean'
        ]);

        $fecha_evento = $validated['fecha'];  // Fecha del evento
        $hora_inicio = $validated['hora_inicio'];
        $hora_fin = $validated['hora_fin'];

        // Convertir las fechas y horas a objetos DateTime
        $inicio_evento = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $fecha_evento . ' ' . $hora_inicio);
        $fin_evento_original = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $fecha_evento . ' ' . $hora_fin);

        $fin_evento = (clone $fin_evento_original)->addHour();

        // Validar si ya existe otro evento en el mismo día y que se solape
        $evento_existente = Evento::whereDate('fecha', $fecha_evento)
            ->where(function ($query) use ($inicio_evento, $fin_evento) {
                $query->whereBetween('hora_inicio', [$inicio_evento, $fin_evento])
                    ->orWhereBetween('hora_fin', [$inicio_evento, $fin_evento])
                    ->orWhere(function ($query) use ($inicio_evento, $fin_evento) {
                        $query->where('hora_inicio', '<', $inicio_evento)
                            ->where('hora_fin', '>', $fin_evento);
                    });
            })
            ->exists();

        if ($evento_existente) {
            return back()->withErrors(['hora_inicio' => 'Ya existe un evento en este horario, por favor elige otro horario.']);
        }

        $evento = Evento::create([
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


        return redirect()->route('eventos.index')->with('success', 'Solicitud creada con éxito');
    }

    // Mostrar los detalles de una solicitud
    public function show(Evento $evento)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Eventos', 'url' => route('eventos.index')],
            ['name' => 'Detalles', 'url' => route('eventos.show', $evento)],

        ];

        $cliente = Cliente::where('evento_id', $evento->id)->first();

        $tipo_servicios = ServicioEvento::where('evento_id', $evento->id)->get()->map(function ($item) {
            return [
                'servicio_id' => $item->servicio_id,
                'nombre_servicio' => Servicio::find($item->servicio_id)->nombre,
                'tipo_servicio_id' => $item->tipo_servicio_id,
                'nombre_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->tipo,
                'caracteristicas_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->caracteristicas,
                'precio_tipo_Servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->precio,
            ];
        });
        $total = $this->calcularTotal($evento);

        $personal = EventoUsuario::where('evento_id', $evento->id)->get()->map(function ($item) {
            $user = User::find($item->user_id);
            return [
                'usuario_id' => $user->id,
                'usuario_nombres' => $user->usuario_nombres,
                'usuario_app' => $user->usuario_app,
                'usuario_apm' => $user->usuario_apm,
                'usuario_telefono' => $user->usuario_telefono,
                'roles' => $user->getRoleNames()->first()
            ];
        })->groupBy('roles');


        return view('eventos.detalle', compact('personal', 'total', 'tipo_servicios', 'evento', 'breadcrumb', 'cliente'));
    }
    private function calcularTotal(Evento $evento): float
    {
        $horaInicio = Carbon::parse($evento->hora_inicio);
        $horaFin = Carbon::parse($evento->hora_fin);
        $duracionHoras = $horaInicio->diffInHours($horaFin);

        $tipo_servicios = ServicioEvento::where('evento_id', $evento->id)->get()->map(function ($item) {
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
    // Mostrar el formulario para editar una solicitud
    public function edit(Evento $evento)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Eventos', 'url' => route('eventos.index')],
            ['name' => 'Crear', 'url' => route('eventos.edit', $evento)],

        ];
        return view('eventos.edit', compact('evento', 'breadcrumb'));
    }

    // Actualizar una solicitud en la base de datos
    public function update(Request $request, Evento $evento)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'ubicacion' => 'nullable|string|max:255',
            'geolocalizacion' => 'nullable|string|max:255',
            'estado' => 'required|boolean'
        ]);

        $evento->update($validated);

        return redirect()->route('eventos.index')->with('success', 'Solicitud actualizada con éxito');
    }

    // Eliminar una solicitud de la base de datos
    public function destroy(Evento $evento)
    {
        $evento->delete();

        return redirect()->route('eventos.index')->with('success', 'Solicitud eliminada con éxito');
    }
    public function recibo(Evento $evento)
    {

        $cliente = Cliente::where('evento_id', $evento->id)->first();

        $tipo_servicios = ServicioEvento::where('evento_id', $evento->id)->get()->map(function ($item) {
            return [
                'servicio_id' => $item->servicio_id,
                'nombre_servicio' => Servicio::find($item->servicio_id)->nombre,
                'tipo_servicio_id' => $item->tipo_servicio_id,
                'nombre_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->tipo,
                'caracteristicas_tipo_servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->caracteristicas,
                'precio_tipo_Servicio' => Tipo_Servicio::find($item->tipo_servicio_id)->precio,
            ];
        });
        $total = $this->calcularTotal($evento);

        $personal = EventoUsuario::where('evento_id', $evento->id)->get()->map(function ($item) {
            $user = User::find($item->user_id);
            return [
                'usuario_id' => $user->id,
                'usuario_nombres' => $user->usuario_nombres,
                'usuario_app' => $user->usuario_app,
                'usuario_apm' => $user->usuario_apm,
                'usuario_telefono' => $user->usuario_telefono,
                'roles' => $user->getRoleNames()->first()
            ];
        });

        $pdf = PDF::loadView('eventos.recibo', compact('personal', 'total', 'tipo_servicios', 'evento', 'cliente'));

        return $pdf->download('Recibo' . $evento->titulo . '.pdf');
    }

    public function email(Evento $evento, Cliente $cliente)
    {
        $cliente = Cliente::where('evento_id', $evento->id)->first();


        Mail::to($cliente->email)->send(new notificarCliente($evento));

        return redirect()->back()->with('success', 'Notificacion enviada al cliente con exito');

    }
}
