<div class="mt-8 px-4 flex justify-center">
    <div class="min-w-[600px] max-w-max overflow-x-auto bg-zinc-900 border border-zinc-700 rounded-xl shadow p-6 space-y-6">
        <h1 class="text-2xl font-bold text-white">Administrar usuarios</h1>

        {{-- Mensajes --}}
        @if (session()->has('success'))
            <div class="text-green-400 text-sm">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="text-red-400 text-sm">{{ session('error') }}</div>
        @endif
        @if (session()->has('info'))
            <div class="text-yellow-400 text-sm">{{ session('info') }}</div>
        @endif

        {{-- Barra de búsqueda --}}
        <div class="flex justify-center mt-6">
            <input
                type="search"
                placeholder="Buscar por nombre o correo..."
                wire:model.debounce.500ms="busqueda"
                class="w-full max-w-md bg-zinc-800 border border-zinc-600 text-white rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zinc-400 placeholder:text-zinc-400 text-sm"
            >
        </div>

        {{-- Tabla con scroll horizontal en pantallas pequeñas --}}
        <div class="overflow-x-auto items-center">
            <table class="main-w-[600px] table-auto text-sm border-separate border-spacing-y-2">
                <thead class="text-zinc-400 uppercase">
                    <tr>
                        <th class="text-left px-4 py-2">Nombre</th>
                        <th class="text-left px-4 py-2">Correo</th>
                        <th class="text-left px-4 py-2">Rol</th>
                        <th class="text-left px-4 py-2">Teléfono</th>
                        <th class="text-left px-4 py-2">Contraseña</th>
                        <th class="text-left px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr class="bg-zinc-800 text-zinc-100 rounded-md shadow-sm">
                            <td class="px-4 py-2">{{ $usuario->name }}</td>
                            <td class="px-4 py-2">{{ $usuario->email }}</td>
                            <td class="px-4 py-2">{{ ucfirst($usuario->rol) }}</td>
                            <td class="px-4 py-2">{{ $usuario->telefono }}</td>
                            <td class="px-4 py-2 text-sm text-white">
                                @php
                                    $esAdminProtegido = $usuario->rol === 'admin' && $usuario->id !== auth()->id();
                                    $esAdminActual = $usuario->id === auth()->id();
                                @endphp

                                <div x-data="{ mostrar: false }" class="relative">
                                    <input
                                        :type="mostrar ? 'text' : 'password'"
                                        value="********"
                                        disabled
                                        class="w-full bg-zinc-800 text-white border border-zinc-600 rounded-md px-3 py-1 text-sm pr-10 opacity-80"
                                    >

                                    <button
                                        type="button"
                                        x-on:click="mostrar = !mostrar"
                                        class="absolute right-2 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-white"
                                        :disabled="{{ $esAdminProtegido ? 'true' : 'false' }}"
                                        x-bind:title="mostrar ? 'Ocultar contraseña' : 'Mostrar contraseña'"
                                    >
                                        <svg x-show="!mostrar" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z" />
                                        </svg>

                                        <svg x-show="mostrar" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.038-3.368m1.537-1.537A9.969 9.969 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.963 9.963 0 01-4.293 5.368M3 3l18 18" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-4 py-2">
                                <div class="flex flex-wrap gap-2">
                                    @php
                                        $esAdminProtegido = $usuario->rol === 'admin' && $usuario->id !== auth()->id();
                                        $esAdminActual = $usuario->rol === 'admin' && $usuario->id === auth()->id();
                                    @endphp

                                    {{-- Botón Editar --}}
                                    @if ($esAdminProtegido)
                                        {{-- Otro admin protegido --}}
                                        <button
                                            onclick="window.dispatchEvent(new CustomEvent('notificacion', { detail: { tipo: 'error', mensaje: 'Acción no disponible para estos usuarios' }}))"
                                            class="px-4 py-2 bg-zinc-800 text-zinc-800 text-sm font-semibold rounded-md cursor-default"
                                        >
                                            Editar
                                        </button>
                                    @elseif ($esAdminActual)
                                        {{-- Admin actual: botón a settings --}}
                                        <a
                                            href="{{ route('settings.profile') }}"
                                            class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-md hover:bg-indigo-500 transition"
                                        >
                                            Usuario actual
                                        </a>
                                    @else
                                        {{-- Usuario editable normal --}}
                                        <button
                                            wire:click="editar({{ $usuario->id }})"
                                            class="px-4 py-2 bg-white text-black text-sm font-semibold rounded-md hover:bg-zinc-200 transition"
                                        >
                                            Editar
                                        </button>
                                    @endif

                                    {{-- Botón Eliminar --}}
                                    @if (!$esAdminProtegido && !$esAdminActual)
                                        <button
                                            onclick="if (confirm('¿Estás segura de que quieres eliminar este usuario?')) { @this.call('eliminar', {{ $usuario->id }}) }"
                                            class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md hover:bg-red-500 transition"
                                        >
                                            Eliminar
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Formulario de edición --}}
        @if ($modoEdicion)
            <div class="border-t border-zinc-700 pt-6">
                <h2 class="text-lg font-semibold text-white mb-6">Editar Usuario</h2>
                <form wire:submit.prevent="actualizar" class="space-y-4">
                    <div class="space-y-2">
                        <label for="nombre" class="block text-sm text-zinc-300 mb-1">Nombre</label>
                        <input
                            type="text"
                            id="nombre"
                            wire:model="nombre"
                            class="w-full bg-zinc-800 text-white border border-zinc-600 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zinc-400 placeholder:text-zinc-400 text-sm"
                        >
                        @error('nombre') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-2">
                        <label for="telefono" class="block text-sm text-zinc-300 mb-1">Teléfono</label>
                        <input
                            type="text"
                            id="telefono"
                            wire:model="telefono"
                            class="w-full bg-zinc-800 text-white border border-zinc-600 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zinc-400 placeholder:text-zinc-400 text-sm"
                        >
                        @error('telefono') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex justify-center gap-4 mt-10">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-white text-black text-sm font-semibold rounded-md shadow-sm hover:bg-zinc-200 transition">
                            Guardar
                        </button>
                        <button type="button" wire:click="$set('modoEdicion', false)" class="inline-flex items-center justify-center px-4 py-2 bg-zinc-600 text-white text-sm font-semibold rounded-md shadow-sm hover:bg-zinc-500 transition">
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</div>