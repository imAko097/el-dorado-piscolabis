<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use Livewire\Component;

class EditarUserForm extends Component
{
    public $name, $email, $password, $password_confirmation, $role;
    public $usuario;
    public $showForm = false;


    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|min:8|same:password_confirmation',
        'role' => 'required|in:admin, empleado, cliente',
    ];

    public function mount($usuario)
    {
        $this->usuario = $usuario;
    }

    protected function puedeEditar()
    {
        $authUser = Auth::user();
        return $authUser && ($authUser->role->name === 'admin' || $authUser->id === $this->usuario->id);
    }



    public function render()
    {
        return view('livewire.editar-user-form');
    }

    public function showModal()
    {
        if (!$this->puedeEditar()) {
            abort(403, 'No tienes permiso para editar este usuario.');
        }

        $this->name = $this->usuario->name;
        $this->email = $this->usuario->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->showForm = true;
    }

    public function storage()
    {
        if (!$this->puedeEditar()) {
            abort(403, 'No tienes permiso para actualizar este usuario.');
        }

        // Validación dinámica
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8|same:password_confirmation',
        ];

        if (Auth::user()->role->name === 'admin') {
            $rules['role'] = 'required|in:admin,empleado,cliente';
        }

        $this->validate($rules);

        if (!$this->usuario) {
            session()->flash('error', 'No se encontró el usuario.');
            return;
        }

        $datos = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if (!empty($this->password)) {
            $datos['password'] = Hash::make($this->password);
        }

        // Solo permitir cambiar el rol si el usuario actual es admin
        if (Auth::user()->role->name === 'admin') {
            $datos['role'] = $this->role;
        }

        $this->usuario->update($datos);

        session()->flash('message', 'Usuario actualizado correctamente.');

        return redirect()->route('usuarios.index');
    }

}