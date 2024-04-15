@extends('layouts.app-user')

@section('title', 'Devolver Petición')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Devolver Petición</h2>
            <form action="{{ route('user.peticion-actualizar', ['peticion' => $peticion->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for=nota_devolucion" class="block text-lg font-semibold">Nota de Devolución</label>
                    <textarea class="mt-1 block w-full border border-gray-200" name="nota_devolucion" id="nota_devolucion" rows="5">{{ $peticion->nota_devolucion ?? old('nota_devolucion') }}</textarea>
                    @error('nota_devolucion')
                        <p class="mt-1 text-sm text-red-600">La nota de devolución es obligatoria</p>
                    @enderror
                </div>
    
                <div class="mt-4">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500" type="submit">Devolver Petición</button>
                </div>
            </form>
        </div>
    </div>
@endsection
