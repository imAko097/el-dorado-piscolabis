<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Carrusel_imagenes;
use Illuminate\Http\Request;

class UploadImagenes extends Component
{
    use WithFileUploads;

    public $imagenes = [];
    public $showForm = false;

    public function showModal()
    {
        $this->showForm = true;
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetErrorBag();
    }


  

    public function subirImagenes()
    {
        $this->validate([
            'imagenes.*' => 'required|file|mimes:jpeg,jpg,png,gif,webp,heic',
        ]);

        foreach ($this->imagenes as $imagen) {
            $path = $imagen->store('uploads', 'public');

            Carrusel_imagenes::create([
                'imagen' => $path,
            ]);
        }

        session()->flash('mensaje', 'Imágenes subidas y guardadas correctamente.');

        $this->reset(['imagenes', 'showForm']);
    }


    public function render()
    {
        return view('livewire.upload-imagenes');
    }
}
