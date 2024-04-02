<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Peticiones | Crear Usuario</title>
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
            <h2 class="text-2xl font-semibold mb-4">Crear Usuario</h2>
            <form action="" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Usuario</label>
                    <input class="mt-1 block w-full border border-gray-200" type="text" name="name" id="name">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">El nombre de usuario es obligatorio</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="email" class="block text-lg font-semibold">Correo Electrónico</label>
                    <input class="mt-1 block w-full border border-gray-200" type="email" name="email" id="email">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">El correo electrónico es obligatorio</p>
                    @enderror
                </div>
    
                <div class="mb-4">
                    <label for="password" class="block text-lg font-semibold">Contraseña</label>
                    <input class="mt-1 block w-full border border-gray-200" type="password" name="password" id="password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">La contraseña es obligatoria</p>
                    @enderror
                </div>
    
                <div class="mt-4">
                    <button class="py-2 px-4 rounded bg-emerald-500 text-white font-semibold hover:bg-emerald-600 duration-500" type="submit">Crear</button>
                </div>
            </form>
        </div>
    </div>
    <!-- CONTENIDO PRINCIPAL -->
</body>

</html>
