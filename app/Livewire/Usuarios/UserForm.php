<?php

namespace App\Livewire\Usuarios;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class UserForm extends Component
{
    public $name, $email, $password, $password_confirmation, $role;
    public $showForm = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'nullable|in:admin,empleado,cliente',
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'password.required' => 'La contraseña es obligatoria.',
    ];

    public function showModal()
    {
        $this->reset();
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);

        $user->role = $this->role ?: 'empleado';

        $user->email_verified_at = now();
        $user->save();

        session()->flash('message', 'Usuario agregado correctamente.');
        return redirect()->route('usuarios.index');
    }




    public function render()
    {
        return view('livewire.usuarios.user-form');
    }

}