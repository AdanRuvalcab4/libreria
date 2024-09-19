<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Libro</title>
</head>
<body>
    <h1>Formulario para registrar un libro {{ $tipo_persona }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/registra-usuario" method="POST">
        @csrf

        @if ($tipo_persona == 'admin')
            <label for="id_libro">id del libro:</label><br>
            <input type="text" name="id_libro" id="id_libro"><br>
        @endif

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}"><br>
        @error('nombre')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <label for="correo">Correo:</label>
        <input type="mail" name="correo" value="{{ old('correo') }}"><br>
        @error('correo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="password">Password:</label>
        <input type="text" name="password" value="{{ old('password') }}"><br>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
     
        <input type="submit" value="Enviar">
    </form>

   
</body>
</html>