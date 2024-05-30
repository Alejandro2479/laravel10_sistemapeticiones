@extends('layouts.app-admin')

@section('title', 'Índice')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Lista de Usuarios</h2>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Usuario</th>
                            <th class="px-4 py-2">Correo Electrónico</th>
                            <th class="px-4 py-2">Cargo</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2 text-center">{{ $user->username }}</td>
                            <td class="px-4 py-2 text-center">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-center">
                                @if($user->rol === 'manager')
                                    Gerente o Coordinador
                                @elseif($user->rol === 'user')
                                    Profesional
                                @elseif($user->rol === 'admin')
                                Administrador
                            @endif
                            </td>
                            <td class="flex flex-col px-4 py-2 items-center justify-center space-y-2 space-x-0 md:flex-row md:space-y-0 md:space-x-2">                            
                                <a href="{{ route('admin.user-editar', ['user' => $user]) }}">
                                    <button class="py-2 px-4 rounded bg-amber-400 text-white font-semibold hover:bg-amber-500 duration-500" type="submit">Editar</button>
                                </a>
                                @if($user->rol !== 'admin')
                                <form action="{{ route('admin.user-eliminar', ['user' => $user]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="py-2 px-4 rounded bg-red-500 text-white font-semibold hover:bg-red-600 duration-500">Eliminar</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="5">No hay usuarios</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
