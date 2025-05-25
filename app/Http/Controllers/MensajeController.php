<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;

class MensajeController extends Controller
{
    public function index()
    {
        $mensajes = Mensaje::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.mensajes.index', compact('mensajes'));
    }
}
