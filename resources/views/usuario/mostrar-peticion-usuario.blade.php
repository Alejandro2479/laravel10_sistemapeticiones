@extends('layouts.app-usuario')

@section('title', 'Mostrar Petición')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Ver Petición</h2>
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Número de Radicado:</h3>
                <p class="text-gray-700">{{ $peticion->numero_radicado }}</p>
            </div>
    
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Asunto:</h3>
                <p class="text-gray-700">{{ $peticion->asunto }}</p>
            </div>
    
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Descripción:</h3>
                <p class="text-gray-700">{{ $peticion->descripcion }}</p>
            </div>
    
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Estatus:</h3>
                <p>
                    @if($peticion->estatus)
                        <span class="font-medium text-green-500">Completa</span>
                    @else
                        <span class="font-medium text-red-500">Incompleta</span>
                    @endif
                </p>
            </div>

            <div class="text-sm">
                <p><strong>Creada el:</strong> {{ $peticion->created_at->format('d/m/Y') }}</p>
                <p><strong>Actualizada el:</strong> {{ $peticion->updated_at->format('d/m/Y') }}</p>
            </div>   

            <div class="flex mt-4 space-x-2">
                @if(!$peticion->estatus) <!-- Solo muestra el botón si el estatus no es 1 (completa) -->
                    <form action="{{ route('peticion.alternar-estatus', ['peticion' => $peticion]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500">Cambiar Estatus</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
