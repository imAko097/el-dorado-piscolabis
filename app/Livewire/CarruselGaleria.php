<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Carrusel_imagenes;
use Illuminate\Support\Facades\Storage;

class CarruselGaleria extends Component
{
    public $imagenes;

    protected $listeners = ['imagenesSubidas' => 'refreshImagenes'];
    public function mount()
    {
        $this->imagenes = Carrusel_imagenes::orderBy('orden')->get();
    }

    public function refreshImagenes()
    {
        $this->imagenes = Carrusel_imagenes::orderBy('orden')->get();
    }

    public function eliminarImagen($id)
    {
        $imagen = Carrusel_imagenes::find($id);

        if ($imagen) {
            if (\Storage::exists($imagen->imagen)) {
                \Storage::delete($imagen->imagen);
            }

            $imagen->delete();
            $this->refreshImagenes();
        }
    }



    public function render()
    {
        return view('livewire.carrusel-galeria');
    }
}
