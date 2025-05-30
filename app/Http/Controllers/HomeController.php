<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Evento;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
        ];

        if (Auth::user()->usuario_fecha_ultimo_password) {
            $ultimoCambio = Carbon::parse(Auth::user()->usuario_fecha_ultimo_password);

            $diferenciaDias = (int) $ultimoCambio->diffInDays(Carbon::now());

            if ($diferenciaDias >= 100) {
                $tiempo_cambio_contraseña = 1;
            } else {
                $tiempo_cambio_contraseña = 2;
            }
        } else {
            $tiempo_cambio_contraseña = 0;
        }
        $total_eventos = Evento::all()->count();
        $total_sol_eventos = Solicitud::all()->count();
        $usuarios = User::all()->count();

        $eventosPorFecha = Evento::select('fecha', DB::raw('COUNT(*) as total'))
            ->groupBy('fecha')
            ->orderBy('fecha', 'asc')
            ->get();

        // Separar datos para pasarlos al gráfico
        $fechas = $eventosPorFecha->pluck('fecha')->map(function ($fecha) {
            return \Carbon\Carbon::parse($fecha)->format('d/m/Y');
        });

        $totales = $eventosPorFecha->pluck('total');




        $solicitudesPorFecha = Solicitud::select('fecha', DB::raw('COUNT(*) as total'))
            ->groupBy('fecha')
            ->orderBy('fecha', 'asc')
            ->get();

        $fechasSolicitudes = $solicitudesPorFecha->pluck('fecha')->map(fn($f) => \Carbon\Carbon::parse($f)->format('d/m/Y'));
        $totalesSolicitudes = $solicitudesPorFecha->pluck('total');

        return view('home', compact('fechasSolicitudes', 'totalesSolicitudes', 'totales', 'fechas', 'usuarios', 'total_sol_eventos', 'total_eventos', 'breadcrumb', 'tiempo_cambio_contraseña'));
    }



}
