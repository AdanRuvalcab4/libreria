<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Libro</title>
</head>
<body>
    <h1>Formulario para registrar un LIBRO </h1>

    <form action="{{ route('libro.store') }}" method="POST">
        @csrf

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}"><br>
        @error('nombre')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <label for="autor">Autor:</label>
        <input type="text" name="autor" value="{{ old('autor') }}"><br>
        @error('autor')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="{{ old('precio') }}"><br>
        @error('precio')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="stock">Stock:</label>
        <input type="text" name="stock" value="{{ old('stock') }}"><br>
        @error('stock')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="descripcion">Descripciom:</label><br>
        <textarea name="descripcion" cols="30" rows="4">{{ old('descripcion') }}</textarea><br>
        @error('descripcion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

     
        <input type="submit" value="Enviar">
    </form>

   
</body>
</html>