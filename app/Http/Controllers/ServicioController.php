<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Servicio;
use App\Models\Tipo_Servicio;
use App\Models\Catalogo;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Servicios', 'url' => route('servicios.index')],
        ];
        $servicios = Servicio::with('tipos')->get();
        return view('servicios.index', compact('servicios', 'breadcrumb'));
    }

    public function create()
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Servicios', 'url' => route('servicios.index')],
        ];
        $inventarios = Inventario::all();
        return view('servicios.create', compact('breadcrumb', 'inventarios'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
            'inventario_id' => 'nullable|exists:inventarios,id',

        ]);

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/servicios'), $filename);
            $data['imagen'] = 'servicios/' . $filename;
        }

        Servicio::create($data);
        return redirect()->route('servicios.index')->with('success', 'Servicio creado correctamente.');
    }

    public function show(Servicio $servicio)
    {
        return view('servicios.show', compact('servicio'));
    }

    public function edit(Servicio $servicio)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Servicios', 'url' => route('servicios.index')],
            ['name' => 'Editar Servicio', 'url' => route('servicios.index')],
        ];
        $inventarios = Inventario::all();
        return view('servicios.edit', compact('inventarios', 'servicio', 'breadcrumb'));
    }


    public function update(Request $request, Servicio $servicio)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
            'role_id' => 'nullable|exists:roles,id',
            'inventario_id' => 'nullable|exists:inventarios,id',

        ]);

        if ($request->hasFile('imagen')) {
            if ($servicio->imagen) {
                Storage::disk('public')->delete($servicio->imagen);
            }
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/servicios'), $filename);
            $data['imagen'] = 'servicios/' . $filename;
        }

        $servicio->update($data);
        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Servicio $servicio)
    {
        if ($servicio->imagen) {
            Storage::disk('public')->delete($servicio->imagen);
        }

        $servicio->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado correctamente.');
    }

    //----------------------

    public function create_tipo_servicio(Servicio $servicio)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Servicios', 'url' => route('servicios.index')],
        ];

        $categorias = Categoria::all();
        $inventarios = Inventario::paginate(10);

        if (request()->ajax()) {
            return view('tipo_servicios._inventarios', compact('inventarios'))->render();
        }
        return view('tipo_servicios.create', compact('servicio', 'inventarios', 'breadcrumb', 'categorias'));
    }

    public function store_tipo_servicio(Request $request)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'tipo' => 'required|string',
            'caracteristicas' => 'nullable|string',
            'precio' => 'nullable|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'catalogo_id' => 'required|string',
            'cantidad_personal' => 'nullable|integer|min:0',
            'cantidad_equipo' => 'nullable|integer|min:0',
            'inventario_id' => 'required|exists:inventarios,id',
        ]);


        Tipo_Servicio::create([
            'servicio_id' => $request->input('servicio_id'),
            'tipo' => $request->input('tipo'),
            'caracteristicas' => $request->input('caracteristicas'),
            'precio' => $request->input('precio'),
            'catalogo_id' => $request->input('catalogo_id'),
            'cantidad_personal' => $request->input('cantidad_personal'),
            'cantidad_equipo' => $request->input('cantidad_personal'),
            'categoria_id' => $request->input('categoria_id'),
            'inventario_id' => $request->input('inventario_id'),
        ]);
        return redirect()->route('servicios.index')->with('success', 'Tipo de servicio creado correctamente.');
    }

    public function edit_tipo_servicio($id)
    {
        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Servicios', 'url' => route('servicios.index')],

            ['name' => 'Editar tipo Servicio', 'url' => route('servicios.index')],
        ];

        $categorias = Categoria::all();
        $tipoServicio = Tipo_Servicio::with('categoria')->findOrFail($id);
        $servicio = Servicio::find($tipoServicio->servicio_id);
        $inventarios = Inventario::paginate(10);

        if (request()->ajax()) {
            return view('tipo_servicios._inventarios', compact('inventarios'))->render();
        }

        return view('tipo_servicios.edit', compact('inventarios', 'tipoServicio', 'servicio', 'breadcrumb', 'categorias'));
    }

    public function update_tipo_servicio(Request $request, $id)
    {
        $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'tipo' => 'required|string',
            'caracteristicas' => 'nullable|string',
            'precio' => 'nullable|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'inventario_id' => 'required|exists:inventarios,id',


            'catalogo_id' => 'required|string',
            'cantidad_personal' => 'nullable|integer|min:0',
            'cantidad_equipo' => 'nullable|integer|min:0',

        ]);

        $tipoServicio = Tipo_Servicio::findOrFail($id);
        $tipoServicio->update($request->all());

        return redirect()->route('servicios.index')->with('success', 'Tipo de servicio actualizado correctamente.');
    }

    public function destroy_tipo_servicio($id)
    {
        $tipoServicio = Tipo_Servicio::findOrFail($id);
        $tipoServicio->delete();

        return redirect()->route('servicios.index')->with('success', 'Tipo de servicio eliminado correctamente.');
    }

    public function porServicio($id)
    {
        $tipos = Tipo_Servicio::where('servicio_id', $id)->get();

        return response()->json($tipos);
    }
}