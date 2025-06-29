<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class EditarUsuario extends Component
{
    public $usuario;

    public function mount(User $usuario)
    {
        if ($usuario->rol === 'admin' && $usuario->id !== Auth::id()) {
            abort(403, 'No puedes editar a otros administradores.');
        }

        $this->usuario = $usuario;
    }

    public function guardar()
    {
        $this->validate([
            'usuario.name' => ['required', 'string', 'max:255'],
            'usuario.telefono' => ['nullable', 'string', 'max:20'],
            'usuario.password' => ['nullable', 'string', 'min:8'], // Opcional: validar solo si cambia
        ]);

        // Si cambió la contraseña y es válida, hashea
        if ($this->usuario->password && strlen($this->usuario->password) > 0) {
            $this->usuario->password = Hash::make($this->usuario->password);
        } else {
            // Evita que se borre accidentalmente si el input estaba vacío
            unset($this->usuario->password);
        }

        $this->usuario->save();

        // Notificación directa tipo toast
        $this->dispatch('notificacion', tipo: 'success', mensaje: 'Usuario actualizado correctamente.');
    }


}
