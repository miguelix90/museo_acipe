<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::withCount('salas')
            ->orderBy('titulo')
            ->paginate(15);

        return view('admin.libros.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.libros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'fecha_edicion' => 'nullable|string|max:255',
            'url_imagen_portada' => 'required|url|max:500',
            'url_resena' => 'nullable|url|max:500',
            'imagen_nube_palabras' => 'nullable|image|max:5120',
        ]);

        $libro = Libro::create($validated);

        // Subir imagen de nube de palabras
        if ($request->hasFile('imagen_nube_palabras')) {
            $libro->addMediaFromRequest('imagen_nube_palabras')
                ->toMediaCollection('imagen_nube_palabras');
        }

        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        $libro->load('salas');
        return view('admin.libros.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        return view('admin.libros.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'fecha_edicion' => 'nullable|string|max:255',
            'url_imagen_portada' => 'required|url|max:500',
            'url_resena' => 'nullable|url|max:500',
            'imagen_nube_palabras' => 'nullable|image|max:5120',
        ]);

        $libro->update($validated);

        // Actualizar imagen de nube de palabras
        if ($request->hasFile('imagen_nube_palabras')) {
            $libro->clearMediaCollection('imagen_nube_palabras');
            $libro->addMediaFromRequest('imagen_nube_palabras')
                ->toMediaCollection('imagen_nube_palabras');
        }

        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro eliminado correctamente.');
    }
}
