@extends('layouts.app-admin')

@section('title', 'Editar Usuario')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Editar Usuario</h2>
            <form action="{{ route('admin.user-actualizar', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Nombre</label>
                    <input class="mt-1 block w-full border border-gray-200" type="text" name="name" id="name" value="{{ $user->name ?? old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">El nombre es obligatorio</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="block text-lg font-semibold">Nombre de Usuario</label>
                    <input class="mt-1 block w-full border border-gray-200" type="text" name="username" id="username" value="{{ $user->username ?? old('username') }}">
                    @error('username')
                        <p class="mt-1 text-sm text-red-600">El nombre de usuario es obligatorio o ya existe</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="cargo" class="block text-lg font-semibold">Cargo</label>
                    <select name="cargo" id="cargo" class="mt-1 w-full border border-gray-200">
                        <option value="">Selecciona un cargo</option>
                        <option value="gerente/coordinador">Gerente o Coordinador</option>
                        <option value="profesional">Profesional</option>
                    </select>
                    @error('cargo')
                        <p class="mt-1 text-sm text-red-600">El cargo es obligatorio</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="email" class="block text-lg font-semibold">Correo Electrónico</label>
                    <input class="mt-1 block w-full border border-gray-200" type="email" name="email" id="email" value="{{ $user->email ?? old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">El correo electrónico es obligatorio o ya existe</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-lg font-semibold">Contraseña</label>
                    <input class="mt-1 block w-full border border-gray-200" type="password" name="password" id="password" value="{{ $user->password ?? old('password') }}">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">La contraseña es obligatoria y debe de ser de minimo 6 caracteres</p>
                    @enderror
                </div>
    
                <div class="mt-4">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500" type="submit">Editar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
