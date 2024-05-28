@extends('layouts.app-user')

@section('title', 'Devolver Petición')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Devolver Derecho de Petición</h2>
            <form action="{{ route('peticion.devolver', ['peticion' => $peticion]) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="razon" class="block text-lg font-semibold">Razon</label>
                    <textarea class="mt-1 block w-full border border-gray-200" name="razon" id="razon" rows="5">{{ old('razon') }}</textarea>
                    @error('razon')
                        <p class="mt-1 text-sm text-red-600">La razon es obligatoria</p>
                    @enderror
                </div>

                <div class="flex mt-4 space-x-2">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500">Devolver</button>
                </div>
            </form>
        </div>
    </div>
@endsection