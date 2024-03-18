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
        <div class="container mx-auto mt-10 mb-10 max-w-lg">
            <div class="border border-sky-600 rounded-lg">
                <div class="m-4">
                    <h1 class="text-2xl mb-4 font-medium">Lista de Peticiones</h1>
                    @forelse($peticions as $peticion)
                    <div>
                        <a href="#">
                            {{ $peticion->numero_radicado }}
                        </a>
                    </div>
                    @empty
                        <div>No hay peticiones</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</body>
</html>
