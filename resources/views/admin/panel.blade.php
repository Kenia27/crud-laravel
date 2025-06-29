<x-layouts.app.sidebar :title="'Admin Panel'">
    <h1 class="text-xl font-bold mb-2">Panel de administrador</h1>
    <p class="mb-4">Bienvenido, {{ Auth::user()->name }}</p>

    <livewire:admin-usuarios />
</x-layouts.app.sidebar>