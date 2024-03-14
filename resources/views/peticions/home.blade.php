<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Peticiones</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Barra Lateral -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4 text-2xl font-bold">Panel Administrador</div>
            <ul class="py-4">
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">Home</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">Crear Peticion</li>
                <li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">Cerrar Sesión</li>
            </ul>
        </div>
        <!-- Barra Lateral -->

        <!-- Contenido Principal -->
        <div class="flex-1 p-10">
            <h1 class="text-3xl font-bold mb-5">Lista de Peticiones</h1>
            <!-- Example Content -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <p>Welcome to the admin panel. This is just a placeholder content.</p>
            </div>
        </div>
    </div>
</body>
</html>
