<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deja tu reseña</title>
</head>
<body>
    <h1>Crear reseña</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('review.store') }}" method="POST">
        @csrf

        <label for="id_book">ID_Book:</label><br>
        <input type="text" name="id_book" value="{{ old('id_book') }}"><br>
        @error('id_book')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="id_user">ID_Usuario:</label><br>
        <input type="text" name="id_user" value="{{ old('id_user') }}"><br>
        @error('id_user')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="titulo">Titulo:</label><br>
        <input type="text" name="titulo" value="{{ old('titulo') }}"><br>
        @error('titulo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="fecha">Fecha:</label><br>
        <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}">
        @error('fecha')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <br><label for="review">Reseña:</label><br>
        <textarea name="review" cols="30" rows="4">{{ old('review') }}</textarea><br>
        @error('review')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <input type="submit" value="Enviar">
    </form>
</body>
</html>