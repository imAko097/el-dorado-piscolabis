<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mensaje;


class ContactoForm extends Component
{
    public $nombre;
    public $email;
    public $mensaje;
    public $successMessage = '';

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mensaje' => 'required|string',
    ];

    public function enviarMensaje()
    {
        $this->validate();

        Mensaje::create([
            'nombre' => $this->nombre,
            'email' => $this->email,
            'mensaje' => $this->mensaje,
        ]);

        $this->successMessage = 'Mensaje enviado correctamente';

        // Limpiar campos
        $this->reset(['nombre', 'email', 'mensaje']);
    }

    public function render()
    {
        return view('livewire.contacto-form');
    }
}
