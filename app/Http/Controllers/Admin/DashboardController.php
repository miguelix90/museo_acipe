<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exposicion;
use App\Models\Sala;
use App\Models\Libro;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'exposiciones' => Exposicion::count(),
            'salas' => Sala::count(),
            'libros' => Libro::count(),
            'usuarios' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
