<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crea un libro</title>
</head>
<body>
    <h1>Crear libro</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('libro.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <label for="nombre">Titulo:</label><br>
        <input type="text" name="nombre" value="{{ old('nombre') }}"><br>
        @error('nombre')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="autor">Autor:</label><br>
        <input type="text" name="autor" value="{{ old('autor') }}"><br>
        @error('autor')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="precio">Precio:</label><br>
        <input type="number" name="precio" value="{{ old('precio') }}"><br>
        @error('precio')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="stock">Stock:</label><br>
        <input type="number" name="stock" value="{{ old('stock') }}"><br>
        @error('stock')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <br><label for="descripcion">Descripcion:</label><br>
        <textarea name="descripcion" cols="30" rows="4">{{ old('descripcion') }}</textarea><br>
        @error('descripcion')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <br><br><input type="file" name="imagen" value="{{ old('imagen') }}"><br><br>
       

        <input type="submit" value="Enviar">
    </form>
</body>
</html>