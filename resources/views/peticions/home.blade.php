<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Peticiones | Home</title>
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
                    <a class="block px-4 py-2" href="{{ route('register.index') }}">Crear Usuario</a>
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
            <h2 class="text-2xl font-semibold mb-4">Lista de Petciones</h2>
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Número de Radicado</th>
                            <th class="px-4 py-2">Asunto</th>
                            <th class="px-4 py-2">Dias Vencimiento</th>
                            <th class="px-4 py-2">Estatus</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peticions as $peticion)
                        <tr class="border-t">
                            <td class="px-4 py-2 text-center">{{ $peticion->numero_radicado }}</td>
                            <td class="px-4 py-2">{{ $peticion->asunto }}</td>
                            <td class="px-4 py-2 text-center">X</td>
                            <td class="px-4 py-2 text-center">{{ $peticion->estatus ? 'Completa' : 'Incompleta' }}</td>
                            <td class="flex flex-col px-4 py-2 items-center justify-center space-y-2 space-x-0 md:flex-row md:space-y-0 md:space-x-2">
                                <a href='{{ route('peticions.mostrar', ['peticion' => $peticion->id]) }}' class="block w-full">
                                    <button class="py-2 px-4 rounded bg-sky-500 text-white font-semibold hover:bg-sky-600 duration-500 w-full">Ver</button>
                                </a>                                
                                <a href="{{ route('peticions.editar', ['peticion' => $peticion]) }}">
                                    <button class="py-2 px-4 rounded bg-amber-400 text-white font-semibold hover:bg-amber-500 duration-500" type="submit">Editar</button>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="5">No hay peticiones</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($peticions->count())
            <nav class="mt-4">
                {{ $peticions->links() }}
            </nav>
            @endif
        </div>
    </div>
    <!-- CONTENIDO PRINCIPAL -->
</body>

</html>
