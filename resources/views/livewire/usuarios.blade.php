<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Lista de Usuarios</h2>

    <div class="mb-4">
        <input wire:model="search"
               type="text"
               placeholder="Buscar usuario..."
               class="w-full px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring">
    </div>

    <table class="w-full border text-left">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Teléfono</th>
                <th class="px-4 py-2">Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $usuario->name }}</td>
                    <td class="px-4 py-2">{{ $usuario->email }}</td>
                    <td class="px-4 py-2">{{ $usuario->telefono }}</td>
                    <td class="px-4 py-2">{{ $usuario->rol }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $usuarios->links() }}
    </div>
</div>