@extends('layouts.app-admin')

@section('title', 'Mostrar Petición')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Ver Petición</h2>
            <div class="border border-gray-200 p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Número de Radicado:</h3>
                <p class="text-gray-700">{{ $peticion->numero_radicado }}</p>
            </div>
    
            <div class="border border-gray-200 p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Asunto:</h3>
                <p class="text-gray-700">{{ $peticion->asunto }}</p>
            </div>
    
            <div class="border border-gray-200 p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Descripción:</h3>
                <p class="text-gray-700">{{ $peticion->descripcion }}</p>
            </div>
    
            <div class="border border-gray-200 p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Estatus:</h3>
                <p>
                    @if($peticion->estatus)
                        <span class="font-medium text-green-500">Completa</span>
                    @else
                        <span class="font-medium text-red-500">Incompleta</span>
                    @endif
                </p>
            </div>

            <p class="text-sm text-gray-500 p-4 mb-4">Creada: {{ $peticion->created_at->diffForHumans() }}</p>

            <div class="flex mt-4 space-x-2">
                @if($peticion->estatus !== 1)
                    <a href="{{ route('admin.peticion-editar', ['peticion' => $peticion]) }}">
                        <button class="py-2 px-4 rounded bg-amber-400 text-white font-semibold hover:bg-amber-500 duration-500" type="submit">Editar</button>
                    </a>
                    <form action="{{ route('admin.peticion-eliminar', ['peticion' => $peticion->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="py-2 px-4 rounded bg-red-500 text-white font-semibold hover:bg-red-600 duration-500">Eliminar</button>
                    </form>
                @endif

                <form action="{{ route('peticion.alternar-estatus', ['peticion' => $peticion]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500">Cambiar Estatus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
