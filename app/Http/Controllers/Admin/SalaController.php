<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use App\Models\Exposicion;
use App\Models\Libro;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas = Sala::with('exposicion')
            ->withCount('libros')
            ->orderBy('orden')
            ->paginate(15);

        return view('admin.salas.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exposiciones = Exposicion::where('activa', true)
            ->orderBy('orden')
            ->get();
        $libros = Libro::orderBy('titulo')->get();

        return view('admin.salas.create', compact('exposiciones', 'libros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'exposicion_id' => 'required|exists:exposicions,id',
            'titulo' => 'required|string|max:255',
            'orden' => 'nullable|integer',
            'activa' => 'boolean',
            'imagen_principal' => 'nullable|image|max:5120',
            'audio' => 'nullable|mimes:mp3,wav,mpeg|max:10240', // 10MB max
            'libros' => 'nullable|array',
            'libros.*' => 'exists:libros,id',
        ]);

        $sala = Sala::create($validated);

        // Subir imagen principal
        if ($request->hasFile('imagen_principal')) {
            $sala->addMediaFromRequest('imagen_principal')
                ->toMediaCollection('imagen_principal');
        }

        // Subir audio
        if ($request->hasFile('audio')) {
            $sala->addMediaFromRequest('audio')
                ->toMediaCollection('audio');
        }

        // Asociar libros
        if ($request->has('libros')) {
            $sala->libros()->attach($request->libros);
        }

        return redirect()->route('admin.salas.index')
            ->with('success', 'Sala creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        $sala->load(['exposicion', 'libros']);
        return view('admin.salas.show', compact('sala'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sala $sala)
    {
        $exposiciones = Exposicion::where('activa', true)
            ->orderBy('orden')
            ->get();
        $libros = Libro::orderBy('titulo')->get();
        $sala->load('libros');

        return view('admin.salas.edit', compact('sala', 'exposiciones', 'libros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sala $sala)
    {
        $validated = $request->validate([
            'exposicion_id' => 'required|exists:exposicions,id',
            'titulo' => 'required|string|max:255',
            'orden' => 'nullable|integer',
            'activa' => 'boolean',
            'imagen_principal' => 'nullable|image|max:5120',
            'audio' => 'nullable|mimes:mp3,wav,mpeg|max:10240',
            'libros' => 'nullable|array',
            'libros.*' => 'exists:libros,id',
        ]);

        $sala->update($validated);

        // Actualizar imagen principal
        if ($request->hasFile('imagen_principal')) {
            $sala->clearMediaCollection('imagen_principal');
            $sala->addMediaFromRequest('imagen_principal')
                ->toMediaCollection('imagen_principal');
        }

        // Actualizar audio
        if ($request->hasFile('audio')) {
            $sala->clearMediaCollection('audio');
            $sala->addMediaFromRequest('audio')
                ->toMediaCollection('audio');
        }

        // Actualizar libros asociados
        if ($request->has('libros')) {
            $sala->libros()->sync($request->libros);
        } else {
            $sala->libros()->detach();
        }

        return redirect()->route('admin.salas.index')
            ->with('success', 'Sala actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        $sala->delete();

        return redirect()->route('admin.salas.index')
            ->with('success', 'Sala eliminada correctamente.');
    }
}
