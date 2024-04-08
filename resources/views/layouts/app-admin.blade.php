<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Peticiones | @yield('title')</title>
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
                <li class="hover:bg-sky-600 duration-500">
                    <a class="block px-4 py-2" href="{{ route('admin.peticion-index') }}">Índice</a>
                </li>                
                <li class="hover:bg-sky-600 duration-500">
                    <a class="block px-4 py-2" href="{{ route('admin.peticion-crear') }}">Crear Petición</a>
                </li>
                <li class="hover:bg-sky-600 duration-500">
                    <a class="block px-4 py-2" href="#">Ver Peticiones Completas</a>
                </li>
                <li class="hover:bg-sky-600 duration-500">
                    <a class="block px-4 py-2" href="{{ route('admin.usuario-crear') }}">Crear Usuario</a>
                </li>
                <li class="hover:bg-sky-600 duration-500">
                    <a class="block px-4 py-2" href="{{ route('admin.usuario-index') }}">Ver Usuarios</a>
                </li>
                <li class="hover:bg-sky-600 duration-500">
                    <a class="block px-4 py-2" href="{{ route('login.eliminar') }}">Cerrar Sesión</a>
                </li>    
            </ul>
        </nav>
    </div>
    <!-- BARRA LATERAL -->

    <!-- CONTENIDO PRINCIPAL -->
    @yield('contenido_principal')
    <!-- CONTENIDO PRINCIPAL -->
</body>

</html>
