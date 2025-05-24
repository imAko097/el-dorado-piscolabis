<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Carrusel_imagenes;

class UploadImagenes extends Component
{
    use WithFileUploads;

    public $imagenes = [];
    public $showForm = false;
    public $mensajeError = '';

    public function showModal()
    {
        $this->showForm = true;
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->reset(['imagenes', 'mensajeError']);
        $this->resetErrorBag();
    }

    public function subirImagenes()
    {
        $totalActual = \App\Models\Carrusel_imagenes::count();

        if (($totalActual + count($this->imagenes)) > 6) {
            $this->addError('limite', 'No puedes subir más de 6 imágenes al carrusel.');
            return;
        }

        $this->validate([
            'imagenes.*' => 'required|file|mimes:jpeg,jpg,png,gif,webp,heic',
        ]);

        $totalExistentes = Carrusel_imagenes::count();
        $totalNuevas = count($this->imagenes);

        if (($totalExistentes + $totalNuevas) > 6) {
            $this->addError('imagenes', 'Solo se permiten un máximo de 6 imágenes en el carrusel.');
            return;
        }

        foreach ($this->imagenes as $imagen) {
            $path = $imagen->store('uploads', 'public');

            Carrusel_imagenes::create([
                'imagen' => $path,
            ]);
        }

        session()->flash('mensaje', 'Imágenes subidas correctamente.');
        $this->dispatch('imagenesSubidas');
        $this->reset(['imagenes', 'showForm']);
    }


    public function render()
    {
        return view('livewire.upload-imagenes');
    }
}
