<?php

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserExportController extends Controller
{
    public function export(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="usuarios.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',

        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Nombre', 'Correo', 'Teléfono', 'Rol']);

            foreach (User::all() as $user) {
                fputcsv($handle, [
                    $user->name,
                    $user->email,
                    $user->telefono,
                    $user->rol,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}