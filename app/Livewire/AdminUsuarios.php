<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AdminUsuarios extends Component
{
    public $usuarios;
    public $modoEdicion = false;
    public $usuarioEditando;
    public $nombre = '';
    public $telefono = '';
    public string $busqueda = '';

    public function mount()
    {
        $this->usuarios = User::all();
    }

    public function eliminar($id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->rol === 'admin') {
            session()->flash('error', 'No se puede eliminar un administrador.');
            return;
        }

        $usuario->delete();
        $this->usuarios = User::all();
        session()->flash('success', 'Usuario eliminado correctamente.');
    }

    public function editar($id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->rol === 'admin') {
            session()->flash('error', 'No se puede editar un administrador.');
            return;
        }

        $this->usuarioEditando = $usuario;
        $this->nombre = $usuario->name;
        $this->telefono = $usuario->telefono;
        $this->modoEdicion = true;
    }


    public function render()
    {
        $usuarios = User::query()
            ->where('name', 'like', '%' . $this->busqueda . '%')
            ->orWhere('email', 'like', '%' . $this->busqueda . '%')
            ->get();

        return view('livewire.admin-usuarios', ['usuarios' => $usuarios]);
    }

    public function actualizar()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|min:8|max:15',
        ]);

        $this->usuarioEditando->update([
            'name' => $this->nombre,
            'telefono' => $this->telefono,
        ]);

        $this->modoEdicion = false;
        $this->usuarios = User::all();
        session()->flash('success', 'Usuario actualizado correctamente.');
    }
}
