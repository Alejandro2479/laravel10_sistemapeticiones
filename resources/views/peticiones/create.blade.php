<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creación de Peticiones</title>
</head>
<body>
    <div>
        <form method="POST" action="{{ route('peticiones.store') }}">
            @csrf
            <div>
                <label for="nombre">Nombre Petición</label>
                <input type="text" name="nombre" id="nombre">
            </div>
            <div>
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion">
            </div>
            
            <div>
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>