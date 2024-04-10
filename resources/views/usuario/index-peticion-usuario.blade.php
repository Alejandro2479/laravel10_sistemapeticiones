@extends('layouts.app-usuario')

@section('title', 'Índice')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <div class="flex flex-col md:flex-row md:justify-between">
                <h2 class="text-2xl font-semibold mb-4">Lista de Peticiones</h2>
            
                <form class="flex items-center space-x-2 mb-4 md:mb-0" method="GET" action="{{ route('usuario.peticion-index') }}">
                    <input class="w-60 border rounded-md border-slate-300 py-1 px-2 leading-tight focus:outline-none" type="text" name="numero_radicado" placeholder="Buscar por número de radicado" value="{{ request('numero_radicado') }}">
                    <button class="rounded py-1 px-2 text-sm font-semibold text-slate-500 ring-1 ring-slate-500 hover:bg-slate-50 duration-500" type="submit">Buscar</button>
                    <a class="rounded py-1 px-2 text-sm font-semibold text-slate-500 ring-1 ring-slate-500 hover:bg-slate-50 duration-500" href="{{ route('usuario.peticion-index') }}">Limpiar</a>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Número de Radicado</th>
                            <th class="px-4 py-2">Asunto</th>
                            <th class="px-4 py-2">Estatus</th>
                            <th class="px-4 py-2">Fecha de Ingreso</th>
                            <th class="px-4 py-2">Fecha de Vencimiento</th>
                            <th class="px-4 py-2">Días Restantes</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peticiones as $peticion)
                        <tr class="border-t">
                            <td class="px-4 py-2 text-center">{{ $peticion->numero_radicado }}</td>
                            <td class="px-4 py-2">{{ $peticion->asunto }}</td>
                            <td class="px-4 py-2 text-center">{{ $peticion->estatus ? 'Completa' : 'Incompleta' }}</td>
                            <td class="px-4 py-2 text-center">{{ $peticion->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 text-center">{{ $peticion->fecha_vencimiento->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 text-center font-semibold">
                                <span class="
                                    inline-block align-middle
                                    @if ($peticion->dias >= 1 && $peticion->dias <= 5)
                                        bg-red-500 text-white
                                    @elseif ($peticion->dias >= 6 && $peticion->dias <= 15)
                                        bg-orange-500 text-white
                                    @elseif ($peticion->dias >= 16)
                                        bg-green-500 text-white
                                    @endif
                                        rounded py-1 px-2 h-8 w-8">
                                    {{ $peticion->dias }}
                                </span>
                            </td>
                            <td class="flex flex-col px-4 py-2 items-center justify-center space-y-2 space-x-0 md:flex-row md:space-y-0 md:space-x-2">
                                <a href='{{ route('admin.peticion-mostrar', ['peticion' => $peticion->id]) }}' class="w-full">
                                    <button class="py-2 px-4 rounded bg-sky-500 text-white font-semibold hover:bg-sky-600 duration-500 w-full">Ver</button>
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
