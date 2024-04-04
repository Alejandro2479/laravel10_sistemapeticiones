@extends('layouts.app-admin')

@section('title', 'Crear Usuario')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Crear Usuario</h2>
            <form action="{{ route('admin.usuario-guardar') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Usuario</label>
                    <input class="mt-1 block w-full border border-gray-200" type="text" name="name" id="name" value="{{ $user->name ?? old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">El nombre de usuario es obligatorio</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="email" class="block text-lg font-semibold">Correo Electrónico</label>
                    <input class="mt-1 block w-full border border-gray-200" type="email" name="email" id="email" value="{{ $user->email ?? old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">El correo electrónico es obligatorio</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="password" class="block text-lg font-semibold">Contraseña</label>
                    <input class="mt-1 block w-full border border-gray-200" type="password" name="password" id="password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">La contraseña es obligatoria y debe de ser de minimo 6 caracteres</p>
                    @enderror
                </div>
    
                <div class="mt-4">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500" type="submit">Crear</button>
                </div>
            </form>
        </div>
    </div>
@endsection
