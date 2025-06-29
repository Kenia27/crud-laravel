<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CrudUsuarioController;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Usuarios\EditarUsuario;
use App\Http\Controllers\UserExportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/usuarios/exportar', [App\Http\Controllers\UserExportController::class, 'export'])
    ->middleware('auth')
    ->name('users.export');

Route::resource('usuarios', CrudUsuarioController::class);

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/usuarios/{usuario}/editar', EditarUsuario::class)
    ->middleware(['auth'])
    ->name('usuarios.editar');

require __DIR__.'/auth.php';

// Rutas protegidas
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::get('/admin', function () {
        if (Auth::user()->rol !== 'admin') {
            abort(403);
        }
        return view('admin.panel');
    })->name('admin.panel');

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});