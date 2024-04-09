@extends('layouts.app-admin')

@section('title', 'Índice')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <div class="flex flex-col md:flex-row md:justify-between">
                <h2 class="text-2xl font-semibold mb-4">Lista de Peticiones</h2>
            
                <form class="flex items-center space-x-2 mb-4 md:mb-0" method="GET" action="{{ route('admin.peticion-completa-index') }}">
                    <input class="w-60 border rounded-md border-slate-300 py-1 px-2 leading-tight focus:outline-none" type="text" name="numero_radicado" placeholder="Buscar por número de radicado" value="{{ request('numero_radicado') }}">
                    <button class="rounded py-1 px-2 text-sm font-semibold text-slate-500 ring-1 ring-slate-500 hover:bg-slate-50 duration-500" type="submit">Buscar</button>
                    <a class="rounded py-1 px-2 text-sm font-semibold text-slate-500 ring-1 ring-slate-500 hover:bg-slate-50 duration-500" href="{{ route('admin.peticion-completa-index') }}">Limpiar</a>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Número de Radicado</th>
                            <th class="px-4 py-2">Asunto</th>
                            <th class="px-4 py-2">Dias Vencimiento</th>
                            <th class="px-4 py-2">Estatus</th>
                            <th class="px-4 py-2">Usuario</th>
                            <th class="px-4 py-2">Fecha Ingreso</th>
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
                            <td class="px-4 py-2 text-center">{{ $peticion->user->name }}</td>
                            <td class="px-4 py-2 text-center">{{ $peticion->created_at->format('d/m/Y') }}</td>
                            <td class="flex flex-col px-4 py-2 items-center justify-center space-y-2 space-x-0 md:flex-row md:space-y-0 md:space-x-2">
                                <a href='{{ route('admin.peticion-mostrar', ['peticion' => $peticion->id]) }}' class="block w-full">
                                    <button class="py-2 px-4 rounded bg-sky-500 text-white font-semibold hover:bg-sky-600 duration-500 w-full">Ver</button>
                                </a>                                
                                <a href="{{ route('admin.peticion-editar', ['peticion' => $peticion]) }}">
                                    <button class="py-2 px-4 rounded bg-amber-400 text-white font-semibold hover:bg-amber-500 duration-500" type="submit">Editar</button>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="7">No hay peticiones</td>
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
