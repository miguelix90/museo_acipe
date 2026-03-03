<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exposicion;
use Illuminate\Http\Request;

class ExposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $exposiciones = Exposicion::withCount('salas')
            ->when($search, function($query, $search) {
                return $query->where('titulo', 'like', '%' . $search . '%')
                           ->orWhere('subtitulo', 'like', '%' . $search . '%');
            })
            ->orderBy('orden')
            ->paginate(15)
            ->withQueryString();

        return view('admin.exposiciones.index', compact('exposiciones', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.exposiciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'orden' => 'nullable|integer',
            'activa' => 'boolean',
            'imagen' => 'nullable|image|max:5120', // 5MB max
        ]);

        $exposicion = Exposicion::create($validated);

        // Subir imagen si existe
        if ($request->hasFile('imagen')) {
            $exposicion->addMediaFromRequest('imagen')
                ->toMediaCollection('imagen');
        }

        return redirect()->route('admin.exposiciones.index')
            ->with('success', 'Exposición creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exposicion $exposicion)
    {
        $exposicion->load('salas');
        return view('admin.exposiciones.show', compact('exposicion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exposicion $exposicion)
    {
        return view('admin.exposiciones.edit', compact('exposicion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exposicion $exposicion)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'orden' => 'nullable|integer',
            'activa' => 'boolean',
            'imagen' => 'nullable|image|max:5120',
        ]);

        $exposicion->update($validated);

        // Actualizar imagen si existe
        if ($request->hasFile('imagen')) {
            $exposicion->clearMediaCollection('imagen');
            $exposicion->addMediaFromRequest('imagen')
                ->toMediaCollection('imagen');
        }

        return redirect()->route('admin.exposiciones.index')
            ->with('success', 'Exposición actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exposicion $exposicion)
    {
        $exposicion->delete();

        return redirect()->route('admin.exposiciones.index')
            ->with('success', 'Exposición eliminada correctamente.');
    }
}
