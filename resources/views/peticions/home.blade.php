<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Peticiones</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Contenedor Barra y Contenido -->
    <div class="flex flex-col h-screen md:flex-row">
        <!-- Barra Lateral -->
        <div class="w-full bg-sky-600 text-white md:w-64">
            <h1 class="p-4 text-2xl font-bold text-center">
                Panel Administrador
            </h1>
            <ul class="flex flex-row justify-center md:flex-col">
                <li class="hover:bg-sky-700">
                    <a class="block px-4 py-2" href="#">Home</a>
                </li>                
                <li class="hover:bg-sky-700">
                    <a class="block px-4 py-2" href="#">Crear Petición</a>
                </li>    
                <li class="hover:bg-sky-700">
                    <a class="block px-4 py-2" href="#">Cerrar Sesión</a>
                </li>    
            </ul>
        </div>
        <!-- Barra Lateral -->
    
        <!-- Contenido Principal -->
        <div class="mx-auto mt-10 mb-10">
            <div class="m-4">
                <h1 class="text-2xl mb-4 font-medium">Lista de Peticiones</h1>
                <!-- Tabla -->
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border border-slate-500">
                        <thead>
                            <tr class="border border-slate-600">
                                <th class="px-4 py-2">Numero de Radicado</th>
                                <th class="px-4 py-2">Asunto</th>
                                <th class="px-4 py-2">Estatus</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peticions as $peticion)
                            <tr class="border-t border-slate-500">
                                <td class="px-4 py-2">{{ $peticion->numero_radicado }}</td>
                                <td class="px-4 py-2">{{ $peticion->asunto }}</td>
                                <td class="px-4 py-2">{{ $peticion->estatus ? 'Completa' : 'Incompleta' }}</td>
                                <td class="flex flex-col px-4 py-2 items-center justify-center space-y-4 md:flex-row md:space-y-0">
                                    <button class="bg-lime-600 hover:bg-lime-700 text-white px-4 py-1 rounded-lg">
                                        <a href="#">Ver</a>
                                    </button>
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded-lg ml-2">
                                        <a href="#">Eliminar</a>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="px-4 py-2" colspan="4">No hay peticiones</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
