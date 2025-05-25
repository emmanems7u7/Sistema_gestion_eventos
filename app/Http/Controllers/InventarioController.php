<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Categoria;
use App\Models\Inventario;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {

        $breadcrumb = [
            ['name' => 'Inicio', 'url' => route('home')],
            ['name' => 'Inventario de productos', 'url' => route('inventarios.index')],
        ];
        $search = $request->get('search');
        $inventarios = Inventario::with('imagenes')->when($search, function ($query, $search) {
            return $query->where('nombre', 'like', "%{$search}%")
                ->orWhere('descripcion', 'like', "%{$search}%");
        })
            ->paginate(5);
        $categoria = Categoria::find(1);
        $categoria_inventarios = Catalogo::where('categoria_id', $categoria->id)->get();
        return view('inventarios.index', compact('inventarios', 'breadcrumb', 'search', 'categoria_inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'cantidad_disponible' => 'required|integer',
            'categoria' => 'required|string',
            'frecuencia_mantenimiento' => 'required|string',
            'fecha_adquisicion' => 'required|date',
            'imagenes' => 'nullable|array',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        // Crear el registro
        $registro = Inventario::create([
            'nombre' => $validated['nombre'],
            'descripcion' => $validated['descripcion'],
            'cantidad_disponible' => $validated['cantidad_disponible'],
            'categoria' => $validated['categoria'],
            'frecuencia_mantenimiento' => $validated['frecuencia_mantenimiento'],
            'fecha_adquisicion' => $validated['fecha_adquisicion'],

        ]);

        // Guardar las imágenes si existen
        if ($request->has('imagenes')) {
            foreach ($request->file('imagenes') as $image) {
                $path = $image->store('imagenes', 'public');
                Imagen::create([
                    'inventario_id' => $registro->id,
                    'ruta' => $path,
                    'tipo' => 'inventario'

                ]);
            }
        }

        return redirect()->back()->with('success', 'Registro creado exitosamente.');
    }

    public function agregarImagen(Request $request)
    {

        $request->validate([
            'inventario_id' => 'required|exists:inventarios,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $inventario = Inventario::findOrFail($request->inventario_id);

        // Guardar la imagen


        if ($request->hasFile('images')) {
            // Obtener el inventario al que se le van a asociar las imágenes
            $inventario = Inventario::findOrFail($request->inventario_id);

            // Iterar sobre las imágenes cargadas
            foreach ($request->file('images') as $image) {
                // Guardar cada imagen en el almacenamiento público
                $imagePath = $image->store('inventarios', 'public');

                // Crear un nuevo registro en la base de datos para cada imagen
                $inventario->imagenes()->create([
                    'inventario_id' => $inventario->id,
                    'ruta' => $imagePath,
                    'tipo' => 'principal', // O puedes asignar un tipo diferente para cada imagen
                ]);
            }

            return back()->with('success', 'Imágenes cargadas correctamente');
        } else {
            return back()->withErrors(['images' => 'No se ha enviado ninguna imagen.']);
        }

        return back()->with('success', 'Imagen subida exitosamente.');
    }

    // Método para eliminar imagen
    public function eliminarImagen($id)
    {
        $imagen = Imagen::findOrFail($id);

        // Eliminar la imagen del almacenamiento
        Storage::delete($imagen->ruta);

        // Eliminar el registro de la base de datos
        $imagen->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);

        // Suponiendo que tienes una relación de tipo 'hasMany' o una columna que almacena las rutas de las imágenes
        $imagenes = $inventario->imagenes; // O si es una relación, por ejemplo: $inventario->imagenes()->pluck('ruta')->toArray()

        return response()->json([
            'nombre' => $inventario->nombre,
            'descripcion' => $inventario->descripcion,
            'cantidad_disponible' => $inventario->cantidad_disponible,
            'categoria' => $inventario->categoria,
            'frecuencia_mantenimiento' => $inventario->frecuencia_mantenimiento,
            'fecha_adquisicion' => $inventario->fecha_adquisicion,
            'imagenes' => $imagenes->map(function ($imagen) {
                return asset('storage/' . $imagen->ruta); // Ajusta la ruta según tu almacenamiento.
            }),
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $inventario = Inventario::findOrFail($id);

        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad_disponible' => 'required|integer|min:0',
            'categoria' => 'required|string',
            'frecuencia_mantenimiento' => 'nullable|string|max:255',
            'fecha_adquisicion' => 'nullable|date',

        ]);

        // Actualizar datos del inventario
        $inventario->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'cantidad_disponible' => $request->cantidad_disponible,
            'categoria' => $request->categoria,
            'frecuencia_mantenimiento' => $request->frecuencia_mantenimiento,
            'fecha_adquisicion' => $request->fecha_adquisicion,
        ]);

        return back()->with('success', 'Componente actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();

        return response()->json(['success' => true]);
    }
}
