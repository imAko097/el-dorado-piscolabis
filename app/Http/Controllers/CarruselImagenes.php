<?php

namespace App\Http\Controllers;

use App\Models\Carrusel_imagenes;

use Illuminate\Http\Request;

class CarruselImagenes extends Controller
{
    public function index()
    {
        $carrusel_imagenes = Carrusel_imagenes::all();
        return view('admin.carrusel_imagenes.index', compact('carrusel_imagenes'));
    }

    public function updateOrder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            Carrusel_imagenes::where('id', $item['id'])->update(['orden' => $item['position']]);
        }

        return response()->json(['success' => true, 'message' => 'Orden actualizado']);
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids && is_array($ids)) {
            Carrusel_imagenes::whereIn('id', $ids)->delete();
        }

        return redirect()->back()->with('success', 'Imágenes eliminadas correctamente');
    }
}
