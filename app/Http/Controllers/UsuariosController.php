<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::all();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function mount()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            abort(403, 'No tienes permiso para crear usuarios.');
        }
    }
}