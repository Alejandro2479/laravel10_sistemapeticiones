<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Peticiones | Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Contenedor Barra y Contenido -->
    <div class="flex flex-col h-screen md:flex-row">
        <!-- Barra Lateral -->
        <nav class="bg-sky-600 text-white md:w-64">
            <h1 class="p-4 text-2xl font-bold text-center">
                Panel Administrador
            </h1>
            <ul class="flex flex-row justify-center md:flex-col">
                <li class="hover:bg-sky-700 duration-500">
                    <a class="block px-4 py-2" href="#">Home</a>
                </li>                
                <li class="hover:bg-sky-700 duration-500">
                    <a class="block px-4 py-2" href="{{ route('peticions.crear-peticion') }}">Crear Petición</a>
                </li>    
                <li class="hover:bg-sky-700 duration-500">
                    <a class="block px-4 py-2" href="{{ route('peticions.crear-usuario') }}">Crear Usuario</a>
                </li>    
                <li class="hover:bg-sky-700 duration-500">
                    <a class="block px-4 py-2" href="#">Cerrar Sesión</a>
                </li>    
            </ul>
        </nav>
        <!-- Barra Lateral -->
    
        <!-- Contenido Principal -->
        <div class="mx-auto mt-10 mb-10">
            <div class="mx-4">
                <h1 class="text-2xl mb-4 font-medium">Lista de Peticiones</h1>                
                <!-- Tabla -->
                <table class="w-full table-auto border border-slate-500 overflow-x-scroll">
                    <thead>
                        <tr class="border border-slate-600">
                            <th class="px-4 py-2">Numero de Radicado</th>
                            <th class="px-4 py-2">Asunto</th>
                            <th class="px-4 py-2">Dias Vencimiento</th>
                            <th class="px-4 py-2">Estatus</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peticions as $peticion)
                        <tr class="border-t border-slate-500">
                            <td class="px-4 py-2 text-center">{{ $peticion->numero_radicado }}</td>
                            <td class="px-4 py-2">{{ $peticion->asunto }}</td>
                            <td class="px-4 py-2 text-center">X</td>
                            <td class="px-4 py-2 text-center">{{ $peticion->estatus ? 'Completa' : 'Incompleta' }}</td>
                            <td class="flex flex-col px-4 py-2 items-center justify-center space-y-2 space-x-0 md:flex-row md:space-y-0 md:space-x-2">
                                <button class="block w-full bg-lime-600 text-white px-4 py-1 rounded-lg hover:bg-lime-700 duration-500">
                                    <a href="#">Ver</a>
                                </button>
                                <form action="{{ route('peticions.eliminar', ['peticion' => $peticion->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-4 py-1 rounded-lg hover:bg-red-700 duration-500">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="px-4 py-2" colspan="4">No hay peticiones</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                @if ($peticions->count())
                <nav class="mt-4">
                    {{ $peticions->links() }}
                </nav>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
