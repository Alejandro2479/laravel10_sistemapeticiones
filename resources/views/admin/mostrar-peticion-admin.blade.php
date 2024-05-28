@extends('layouts.app-admin')

@section('title', 'Ver Petición')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Ver Derecho de Petición {{ $peticion->numero_radicado }}</h2>
            <div class="border border-gray-800 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Número de Radicado:</h3>
                <p>{{ $peticion->numero_radicado }}</p>
            </div>
    
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Asunto:</h3>
                <p>{{ $peticion->asunto }}</p>
            </div>
    
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Descripción:</h3>
                <p>{{ $peticion->descripcion }}</p>
            </div>

            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Categoría:</h3>
                <p>{{ ucfirst($peticion->categoria) }}</p>
            </div>

            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Usuarios Asignados:</h3>
                @foreach($peticion->users as $user)
                    <div class="{{ !$loop->last ? 'mb-4' : '' }}">
                        <p>Nombre: {{ $user->name }}</p>
                        <p>Correo Electrónico: {{ $user->email }}</p>
                    </div>
                @endforeach
            </div>
    
            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Estatus:</h3>
                <p>
                    @if($peticion->estatus)
                        <span class="font-medium text-green-500">Completa</span>
                    @else
                        <span class="font-medium text-red-500">Incompleta</span>
                    @endif
                    ({{ $peticion->users()->wherePivot('completado', true)->count() }} de {{ $peticion->users()->count() }} usuarios han completado el derecho de petición)
                </p>
            </div>

            <div class="border border-gray-200 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Respuestas de Completado:</h3>
                @forelse ($peticion->users->reject(function ($user) { return is_null($user->pivot->resumen); }) as $user)
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
                <p>{{ $peticion->fecha_vencimiento->format('d/m/Y') }}</p>
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
                <a href="{{ route('admin.peticion-editar', ['peticion' => $peticion]) }}">
                    <button class="py-2 px-4 rounded bg-amber-400 text-white font-semibold hover:bg-amber-500 duration-500" type="submit">Editar</button>
                </a>

                <form action="{{ route('admin.peticion-eliminar', ['peticion' => $peticion->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="py-2 px-4 rounded bg-red-500 text-white font-semibold hover:bg-red-600 duration-500">Eliminar</button>
                </form>

                <a href="{{ route('all.devoluciones-mostrar', ['peticion' => $peticion]) }}">
                    <button class="py-2 px-4 rounded bg-sky-500 text-white font-semibold hover:bg-sky-600 duration-500" type="submit">Ver Devoluciones</button>
                </a>

                <form action="{{ route('admin.peticion-alternar', ['peticion' => $peticion]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500">Cambiar Estatus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
