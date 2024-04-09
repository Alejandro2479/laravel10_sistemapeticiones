<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Peticiones | Iniciar Sesion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- CONTENEDOR PRINCIPAL -->
    <div class="flex items-center justify-center h-screen bg-sky-500">
        <!-- TARJETA -->
        <div class="bg-lime-600 p-2 mx-6 rounded-2xl">
            <!-- IMAGEN -->
            <img class="object-fit rounded-xl h-80" src="images/logo.jpg" alt="image">
            <!-- IMAGEN -->
            
            <!-- CONTENIDO -->
            <div class="p-6">
                <h2 class="text-xl font-medium text-center text-white">
                    Inicio de Sesión
                </h2>
                <form class="flex flex-col space-y-4" action="" method="POST">
                    @csrf
                    <input class="py-2 px-4 rounded text-center placeholder:text-sm placeholder:text-center" type="text" name="username" id="username" placeholder="Ingresa tu usuario">
                    @error('name')
                    <p class="mt-1 text-sm text-red-600">El usuario es incorrecto</p>
                    @enderror
                    <input class="py-2 px-4 rounded text-center placeholder:text-sm placeholder:text-center" type="password" name="password" id="password" placeholder="Ingresa tu contraseña">
                    @error('password')
                    <p class="mt-1 text-sm text-red-600">La contraseña es incorrecta</p>
                    @enderror
                    <button class="py-2 px-4 rounded text-white bg-lime-500 hover:bg-lime-700 duration-500" type="submit">
                        Iniciar Sesión
                    </button>
                </form>
            </div>
            <!-- CONTENIDO -->
        </div>
        <!-- TARJETA -->
    </div>
     <!-- CONTENEDOR PRINCIPAL -->
</body>

</html>
