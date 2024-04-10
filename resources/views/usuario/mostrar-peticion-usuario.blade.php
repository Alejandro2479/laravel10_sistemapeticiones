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

            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Días para Vencer:</h3>
                <p class="inline-block align-middle text-center font-semibold
                    @if ($peticion->dias >= 1 && $peticion->dias <= 5)
                        bg-red-500 text-white
                    @elseif ($peticion->dias >= 6 && $peticion->dias <= 15)
                        bg-orange-500 text-white
                    @elseif ($peticion->dias >= 16)
                        bg-green-500 text-white
                    @endif
                        rounded py-1 px-2 h-8 w-8">
                    {{ $peticion->dias }}
                </p>
            </div>

            <div class="text-sm">
                <p><strong>Creada el:</strong> {{ $peticion->created_at->format('d/m/Y') }}</p>
                <p><strong>Actualizada el:</strong> {{ $peticion->updated_at->format('d/m/Y') }}</p>
            </div>   

            <div class="flex mt-4 space-x-2">
                @if(!$peticion->estatus)
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
