<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $usuarios = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('telefono', 'like', '%' . $this->search . '%')
            ->orWhere('rol', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.usuarios', [
            'usuarios' => $usuarios,
        ]);
    }
}
