@extends('layouts.app-user')

@section('title', 'Completar Petición')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Completar Derecho de Petición</h2>
            <form action="{{ route('user.peticion-alternar', ['peticion' => $peticion]) }}" method="POST">
                @csrf
                @method('PUT')    
                <div class="mb-4">
                    <label for="resumen" class="block text-lg font-semibold">Resumen</label>
                    <textarea class="mt-1 block w-full border border-gray-200" name="resumen" id="resumen" rows="5">{{ old('resumen') }}</textarea>
                    @error('resumen')
                        <p class="mt-1 text-sm text-red-600">El resumen es obligatorio</p>
                    @enderror
                </div>

                <div class="flex mt-4 space-x-2">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500">Completar</button>
                </div>
            </form>
        </div>
    </div>
@endsection