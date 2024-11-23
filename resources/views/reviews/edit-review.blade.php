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

        <label for="libro_id">Selecciona un libro:</label><br>
        <select name="libro_id" required>
            <option value="{{ old('titulo') ?? $review->libro->nombre }}">-- Selecciona un libro --</option>
            @foreach($libros as $libro)
                <option value="{{ $libro->id }}">{{ $libro->nombre }}</option>
            @endforeach
        </select><br> 
        @error('libro_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="titulo">Titulo:</label><br>
        <input type="text" name="titulo" value="{{ old('titulo') ?? $review->titulo }}"><br>
        @error('titulo')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="fecha">Fecha:</label><br>
        <input type="date" name="fecha" id="fecha" value="{{ old('fecha') ?? $review->fecha}}">
        @error('fecha')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <br><label for="review">Reseña:</label><br>
        <textarea name="review" cols="30" rows="4">{{ old('review') ?? $review->review}}</textarea><br>
        @error('review')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <input type="submit" value="Enviar">

        <a href="{{ route('review.index', $review) }}">Regresar</a>
        
    </form>
</body>
</html>