@php
    $layout = auth()->user()->rol === 'admin' ? 'layouts.app-admin' : 'layouts.app-user';
@endphp

@extends($layout)

@section('title', 'Índice Devoluciones')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <div class="flex flex-col md:flex-row md:justify-between">
                <h2 class="text-2xl font-semibold mb-4">Lista de Devoluciones de Derechos de Petición</h2>
            
                <form class="flex items-center space-x-2 mb-4 md:mb-0" method="GET" action="{{ route('admin.peticion-index') }}">
                    <input class="w-60 border rounded-md border-slate-300 py-1 px-2 leading-tight focus:outline-none" type="text" name="numero_radicado" placeholder="Buscar por número de radicado" value="{{ request('numero_radicado') }}">
                    <button class="rounded py-1 px-2 text-sm font-semibold text-slate-500 ring-1 ring-slate-500 hover:bg-slate-50 duration-500" type="submit">Buscar</button>
                    <a class="rounded py-1 px-2 text-sm font-semibold text-slate-500 ring-1 ring-slate-500 hover:bg-slate-50 duration-500" href="{{ route('admin.peticion-index') }}">Limpiar</a>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Id de Devolucion</th>
                            <th class="px-4 py-2">Número de Petición</th>
                            <th class="px-4 py-2">Usuario</th>
                            <th class="px-4 py-2">Fecha de Ingreso</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($devoluciones as $devolucion)
                        <tr class="border-t">
                            <td class="px-4 py-2 text-center">{{ $devolucion->id }}</td>
                            <td class="px-4 py-2 text-center">{{ $devolucion->peticion->numero_radicado }}</td>
                            <td class="px-4 py-2 text-center">{{ $devolucion->user->name }}</td>
                            <td class="px-4 py-2 text-center">{{ $devolucion->created_at->format('d/m/Y') }}</td>
                            <td class="flex flex-col px-4 py-2 items-center justify-center space-y-2 space-x-0 md:flex-row md:space-y-0 md:space-x-2">
                                <a href='{{ route('all.devolucion-reasignar', ['devolucion' => $devolucion]) }}' class="w-full">
                                    <button class="py-2 px-4 rounded bg-sky-500 text-white font-semibold hover:bg-sky-600 duration-500 w-full">Reasignar</button>
                                </a>                                
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="8">No hay devoluciones de derechos de petición</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($devoluciones->count())
            <nav class="mt-4">
                {{ $devoluciones->links() }}
            </nav>
            @endif
        </div>
    </div>
@endsection
