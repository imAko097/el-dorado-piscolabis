<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();

        $usuarios = User::all()->sortBy(function ($user) use ($authUser) {
            return $user->id === $authUser->id ? 0 : 1;
        })->values();

        return view('admin.usuarios.index', compact('usuarios'));
    }
}