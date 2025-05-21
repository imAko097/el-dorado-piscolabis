<?php

namespace App\Livewire\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        'role' => 'required|in:admin,empleado,cliente',
    ];

    public function mount(User $usuario)
    {
        $this->usuario = $usuario;
    }

    protected function puedeEditar()
    {
        $authUser = Auth::user();
        return $authUser && ($authUser->role === 'admin' || $authUser->id === $this->usuario->id);
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
        $this->role = $this->usuario->role;
        $this->showForm = true;
    }

    public function storage()
    {
        if (!$this->puedeEditar()) {
            abort(403, 'No tienes permiso para actualizar este usuario.');
        }

        $rules = $this->rules;
        if (Auth::user()->role !== 'admin') {
            unset($rules['role']);
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

        if (Auth::user()->role === 'admin') {
            $datos['role'] = $this->role ?? 'empleado';
        }

        $this->usuario->update($datos);

        $this->showForm = false;
        session()->flash('message', 'Usuario actualizado correctamente.');
        return redirect()->route('usuarios.index');
    }

    public function render()
    {
        return view('livewire.usuarios.editar-user-form');
    }
}
