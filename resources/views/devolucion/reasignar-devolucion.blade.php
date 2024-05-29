@extends('layouts.app-admin')

@section('title', 'Reasignar Devolucion')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Reasignar Devolucion de Derecho de Petición {{ $devolucion->peticion->numero_radicado }}</h2>
            <div class="border border-gray-800 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Número de Radicado:</h3>
                <p>{{ $devolucion->peticion->numero_radicado }}</p>
            </div>
    
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Asunto:</h3>
                <p>{{ $devolucion->peticion->asunto }}</p>
            </div>
    
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Descripción:</h3>
                <p>{{ $devolucion->peticion->descripcion }}</p>
            </div>

            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Categoría:</h3>
                <p>{{ ucfirst($devolucion->peticion->categoria) }}</p>
            </div>

            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Usuarios Asignados:</h3>
                @foreach($devolucion->peticion->users as $user)
                    <div class="{{ !$loop->last ? 'mb-4' : '' }}">
                        <p>Nombre: {{ $user->name }}</p>
                        <p>Correo Electrónico: {{ $user->email }}</p>
                    </div>
                @endforeach
            </div>
    
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Estatus:</h3>
                <p>
                    @if($devolucion->peticion->estatus)
                        <span class="font-medium text-green-500">Completa</span>
                    @else
                        <span class="font-medium text-red-500">Incompleta</span>
                    @endif
                    ({{ $devolucion->peticion->users()->wherePivot('completado', true)->count() }} de {{ $devolucion->peticion->users()->count() }} usuarios han completado el derecho de petición)
                </p>
            </div>

            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Respuestas de Completado:</h3>
                @forelse ($devolucion->peticion->users->reject(function ($user) { return is_null($user->pivot->resumen); }) as $user)
                    <div class="{{ !$loop->last ? 'border-b border-gray-200 mb-2' : '' }}">
                        <p>Usuario: {{ $user->name }}</p>
                        <p>Respuesta: {{ $user->pivot->resumen }}</p>
                    </div>
                @empty
                    <p>No hay respuestas</p>
                @endforelse
            </div>

            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Fecha de Vencimineto</h3>
                <p>{{ $devolucion->peticion->fecha_vencimiento->format('d/m/Y') }}</p>
            </div>

            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Días Habiles para Vencer:</h3>
                <p class="inline-block align-middle text-center font-semibold
                    @if ($devolucion->peticion->dias >= 1 && $devolucion->peticion->dias <= 5)
                        bg-red-500 text-white
                    @elseif ($devolucion->peticion->dias >= 6 && $devolucion->peticion->dias <= 15)
                        bg-orange-500 text-white
                    @elseif ($devolucion->peticion->dias >= 16)
                        bg-green-500 text-white
                    @endif
                        rounded py-1 px-2 h-8 w-8">
                    {{ $devolucion->peticion->dias }}
                </p>
            </div>
            
            <form action="{{ route('all.peticion-actualizar', ['devolucion' => $devolucion->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="user_id" class="block text-lg font-semibold">Usuario a Reasignar</label>
                    <select name="user_id" id="user_id" class="mt-1 block w-full border border-gray-200">
                        <option value="">Selecciona un correo electrónico a reasignar</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $devolucion->peticion->user_id == $user->id ? 'selected' : '' }}>{{ $user->email }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">Debes seleccionar un usuario a reasignar</p>
                    @enderror
                </div>

                <div class="text-sm">
                    <p><strong>Creada el:</strong> {{ $devolucion->peticion->created_at->format('d/m/Y') }}</p>
                    <p><strong>Actualizada el:</strong> {{ $devolucion->peticion->updated_at->format('d/m/Y') }}</p>
                </div>
    
                <div class="mt-4">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500" type="submit">Reasignar</button>
                </div>
            </form>
        </div>
    </div>
@endsection