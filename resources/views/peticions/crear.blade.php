<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Peticiones | Crear</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- BARRA LATERAL -->
    <div class="flex-none flex-row h-auto w-full bg-sky-500 text-white md:flex md:flex-col md:h-full md:w-64 md:fixed">
        <nav class="bg-sky-500 text-white md:w-full">
            <h1 class="p-4 text-2xl font-bold text-center">
                Panel Administrador
            </h1>
            <ul class="flex flex-row justify-center font-semibold md:flex-col">
                <li class="hover:bg-sky-700 duration-500">
                    <a class="block px-4 py-2" href="{{ route('peticions.home') }}">Home</a>
                </li>                
                <li class="hover:bg-sky-700 duration-500">
                    <a class="block px-4 py-2" href="{{ route('peticions.crear') }}">Crear Petición</a>
                </li>
                <li class="hover:bg-sky-700 duration-500">
                    <a class="block px-4 py-2" href="#">Cerrar Sesión</a>
                </li>    
            </ul>
        </nav>
    </div>
    <!-- BARRA LATERAL -->

    <!-- CONTENIDO PRINCIPAL -->
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Crear Petición</h2>
            <form action="{{ route('peticions.guardar') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="numero_radicado" class="block">Número de Radicado</label>
                    <input class="mt-1 block w-full rounded-md border border-gray-500" type="text" name="numero_radicado" id="numero_radicado" value="{{ $peticion->numero_radicado ?? old('numero_radicado') }}">
                    @error('numero_radicado')
                        <p class="mt-1 text-sm text-red-600">El número de radicado es obligatorio</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="asunto" class="block">Asunto</label>
                    <textarea class="mt-1 block w-full rounded-md border border-gray-500" name="asunto" id="asunto" rows="5">{{ $peticion->asunto ?? old('asunto') }}</textarea>
                    @error('asunto')
                        <p class="mt-1 text-sm text-red-600">El asunto es obligatorio</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="descripcion" class="block">Descripción</label>
                    <textarea class="mt-1 block w-full rounded-md border border-gray-500" name="descripcion" id="descripcion" rows="5">{{ $peticion->descripcion ?? old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="mt-1 text-sm text-red-600">La descripción es obligatoria</p>
                    @enderror
                </div>
    
                <div class="mt-4">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-lime-700 duration-500" type="submit">Crear</button>
                </div>
            </form>
        </div>
    </div>
    <!-- CONTENIDO PRINCIPAL -->
</body>

</html>