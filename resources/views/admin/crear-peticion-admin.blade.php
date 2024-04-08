@extends('layouts.app-admin')

@section('title', 'Crear Petición')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Crear Petición</h2>
            <form action="{{ route('admin.peticion-guardar') }}" method="POST">
                @csrf
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

                <div class="mb-4">
                    <label for="user_id" class="block text-lg font-semibold">Usuario</label>
                    <select name="user_id" id="user_id" class="mt-1 block w-full border border-gray-200">
                        <option>Selecciona un correo electrónico</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">Debes seleccionar un usuario</p>
                    @enderror
                </div>                
    
                <div class="mt-4">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500" type="submit">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection
