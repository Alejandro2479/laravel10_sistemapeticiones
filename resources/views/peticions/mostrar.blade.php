<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Peticiones | Ver</title>
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
            <h2 class="text-2xl font-semibold mb-4">Ver Petición</h2>
            <div class="border border-gray-200 p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Número de Radicado:</h3>
                <p class="text-gray-700">{{ $peticion->numero_radicado }}</p>
            </div>
    
            <div class="border border-gray-200 p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Asunto:</h3>
                <p class="text-gray-700">{{ $peticion->asunto }}</p>
            </div>
    
            <div class="border border-gray-200 p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Descripción:</h3>
                <p class="text-gray-700">{{ $peticion->descripcion }}</p>
            </div>
    
            <div class="border border-gray-200 p-4 mb-4">
                <h3 class="text-lg font-semibold mb-2">Estatus:</h3>
                <p>
                    @if($peticion->estatus)
                        <span class="font-medium text-green-500">Completa</span>
                    @else
                        <span class="font-medium text-red-500">Incompleta</span>
                    @endif
                </p>
            </div>

            <p class="text-sm text-gray-500 p-4 mb-4">Creada: {{ $peticion->created_at->diffForHumans() }}</p>

            <div class="flex mt-4 space-x-2">
                <a href="{{ route('peticions.editar', ['peticion' => $peticion]) }}">
                    <button class="py-2 px-4 rounded bg-amber-400 text-white font-semibold hover:bg-amber-500 duration-500" type="submit">Editar</button>
                </a>
                <form action="{{ route('peticions.alternar-estatus', ['peticion' => $peticion]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500">Cambiar Estatus</button>
                </form>
                <form action="{{ route('peticions.eliminar', ['peticion' => $peticion->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="py-2 px-4 rounded bg-red-500 text-white font-semibold hover:bg-red-600 duration-500">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- CONTENIDO PRINCIPAL -->
</body>

</html>