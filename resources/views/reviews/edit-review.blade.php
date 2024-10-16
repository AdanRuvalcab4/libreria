<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Reviews</title>
</head>
<body>
    <h1>Editar Reviews</h1>

    <form action="{{ route('review.update', $review) }}" method="POST">
        @csrf
        @method('PATCH')
        <label for="titulo">Titulo:</label><br>
        <input
            type="text"
            name="titulo"
            value="{{ old('titulo') ?? $review->titulo }}"
        >
        <br>

        <label for="fecha">Fecha:</label><br>
        <input type="date" name="fecha" id="fecha" value="{{ old('fecha') ?? $review->fecha }}">

        <label for="review">Reseña:</label><br>
        <textarea name="noticia" cols="30" rows="4">{{ old('review') ?? $review->review }}</textarea><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>