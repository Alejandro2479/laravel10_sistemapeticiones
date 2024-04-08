@extends('layouts.app-usuario')

@section('title', 'Índice')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Lista de Peticiones</h2>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Número de Radicado</th>
                            <th class="px-4 py-2">Asunto</th>
                            <th class="px-4 py-2">Dias Vencimiento</th>
                            <th class="px-4 py-2">Estatus</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peticiones as $peticion)
                        <tr class="border-t">
                            <td class="px-4 py-2 text-center">{{ $peticion->numero_radicado }}</td>
                            <td class="px-4 py-2">{{ $peticion->asunto }}</td>
                            <td class="px-4 py-2 text-center">X</td>
                            <td class="px-4 py-2 text-center">{{ $peticion->estatus ? 'Completa' : 'Incompleta' }}</td>
                            <td class="flex flex-col px-4 py-2 items-center justify-center space-y-2 space-x-0 md:flex-row md:space-y-0 md:space-x-2">
                                <a href='{{ route('usuario.peticion-mostrar', ['peticion' => $peticion->id]) }}'>
                                    <button class="py-2 px-4 rounded bg-sky-500 text-white font-semibold hover:bg-sky-600 duration-500 w-full">Ver</button>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="5">No hay peticiones</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($peticiones->count())
            <nav class="mt-4">
                {{ $peticiones->links() }}
            </nav>
            @endif
        </div>
    </div>
@endsection
