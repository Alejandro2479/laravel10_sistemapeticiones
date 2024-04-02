@extends('layouts.app')

@section('title', 'Índice')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Lista de Usuarios</h2>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Usuario</th>
                            <th class="px-4 py-2">Correo Electrónico</th>
                            <th class="px-4 py-2">Contraseña</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->password }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="5">No hay peticiones</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
