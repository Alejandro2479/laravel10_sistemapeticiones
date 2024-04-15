@extends('layouts.app-admin')

@section('title', 'Editar Petición')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Editar Petición</h2>
            <form action="{{ route('admin.peticion-actualizar', ['peticion' => $peticion->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="numero_radicado" class="block text-lg font-semibold">Número de Radicado</label>
                    <input class="mt-1 block w-full border border-gray-200" type="text" name="numero_radicado" id="numero_radicado" value="{{ $peticion->numero_radicado ?? old('numero_radicado') }}">
                    @error('numero_radicado')
                        <p class="mt-1 text-sm text-red-600">El número de radicado es obligatorio</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="asunto" class="block text-lg font-semibold">Asunto</label>
                    <textarea class="mt-1 block w-full border border-gray-200" name="asunto" id="asunto" rows="5">{{ $peticion->asunto ?? old('asunto') }}</textarea>
                    @error('asunto')
                        <p class="mt-1 text-sm text-red-600">El asunto es obligatorio</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="descripcion" class="block text-lg font-semibold">Descripción</label>
                    <textarea class="mt-1 block w-full border border-gray-200" name="descripcion" id="descripcion" rows="5">{{ $peticion->descripcion ?? old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="mt-1 text-sm text-red-600">La descripción es obligatoria</p>
                    @enderror
                </div>

                @if($peticion->nota_devolucion || $peticion->nombre_devolucion || $peticion->email_devolucion)
                <div class="border border-gray-200 p-2 mb-4">
                    <h3 class="text-lg font-semibold mb-2">Devolución:</h3>
                    @if($peticion->nota_devolucion)
                        <h4><strong style="font-weight: 600;">Nota:</strong></h4>
                        <p class="mb-2">{{ $peticion->nota_devolucion }}</p>
                    @endif
    
                    <h4><strong style="font-weight: 600;">Usuario que hizo la devolución:</strong></h4>
                    <p>{{ $peticion->nombre_devolucion }}</p>
                    <p>{{ $peticion->email_devolucion }}<p>
                </div>
                @endif

                <div class="mb-4">
                    <label for="fecha_vencimiento" class="block text-lg font-semibold">Fecha de Vencimiento</label>
                    <input class="mt-1 w-46 border border-gray-200" type="date" name="fecha_vencimiento" id="fecha_vencimiento" value="{{ $peticion->fecha_vencimiento ?? old('fecha_vencimiento') }}">
                    @error('fecha_vencimiento')
                        <p class="mt-1 text-sm text-red-600">La fecha de vencimiento es obligaoria y debe ser una fecha posterior al día actual</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="user_id" class="block text-lg font-semibold">Usuario</label>
                    <select name="user_id" id="user_id" class="mt-1 block w-full border border-gray-200">
                        <option>Selecciona un correo electrónico</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $peticion->user_id == $user->id ? 'selected' : '' }}>{{ $user->email }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">Debes seleccionar un usuario</p>
                    @enderror
                </div>  
    
                <div class="mt-4">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500" type="submit">Editar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
