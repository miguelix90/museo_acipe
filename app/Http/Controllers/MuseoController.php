<?php

namespace App\Http\Controllers;

use App\Models\Exposicion;
use App\Models\Sala;
use App\Models\Libro;
use Illuminate\Http\Request;

class MuseoController extends Controller
{
    /**
     * Página principal del museo
     */
    public function index()
    {
        // Obtener la última exposición (destacada grande)
        $destacada = Exposicion::where('activa', true)
            ->orderBy('created_at', 'desc')
            ->first();

        // Obtener las 3 siguientes exposiciones
        $siguientes = Exposicion::where('activa', true)
            ->orderBy('created_at', 'desc')
            ->when($destacada, function($query, $destacada) {
                return $query->where('id', '!=', $destacada->id);
            })
            ->take(3)
            ->get();

        return view('museo.home', compact('destacada', 'siguientes'));
    }

    /**
     * Listado de todas las exposiciones
     */
    public function exposiciones()
    {
        $exposiciones = Exposicion::where('activa', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('museo.exposiciones', compact('exposiciones'));
    }

    /**
     * Listado de todas las salas
     */
    public function salas()
    {
        $salas = Sala::where('activa', true)
            ->with('exposicion')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('museo.salas', compact('salas'));
    }

    /**
     * Listado de todos los libros
     */
    public function libros()
    {
        $libros = Libro::orderBy('titulo')
            ->get();

        return view('museo.libros', compact('libros'));
    }

    /**
     * Página Acerca de
     */
    public function acerca()
    {
        return view('museo.acerca');
    }

    /**
     * Detalle de una exposición
     */
    public function exposicion($slug)
    {
        $exposicion = Exposicion::where('slug', $slug)
            ->where('activa', true)
            ->with(['salas' => function($query) {
                $query->where('activa', true)->orderBy('orden');
            }])
            ->firstOrFail();

        return view('museo.exposicion', compact('exposicion'));
    }

    /**
     * Detalle de una sala
     */
    public function sala($exposicion_slug, $sala_slug)
    {
        $exposicion = Exposicion::where('slug', $exposicion_slug)
            ->where('activa', true)
            ->firstOrFail();

        $sala = Sala::where('slug', $sala_slug)
            ->where('exposicion_id', $exposicion->id)
            ->where('activa', true)
            ->with('libros')
            ->firstOrFail();

        return view('museo.sala', compact('exposicion', 'sala'));
    }

    /**
     * Detalle de un libro (opcional)
     */
    public function libro($id)
    {
        $libro = Libro::with('salas.exposicion')->findOrFail($id);

        return view('museo.libro', compact('libro'));
    }
}
