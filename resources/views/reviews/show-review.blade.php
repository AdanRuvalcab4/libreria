<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reviews</title>
</head>
<body>

    <h1>{{ $review->titulo }}</h1>

    <p>Usuario:</p><h2> {{ $review->user->name }}</h2>
    <p>Libro:</p><h2> {{ $review->libro->nombre }}</h2>
    <p>
        Reseña: {{ $review->review }}
    </p>
    <p>
        <ul>
            <li>Fecha: {{ $review->fecha }}</li>
            
        </ul>
    </p>
    <hr>
    <a href="{{ route('review.edit', $review) }}">Editar</a><br><br>

    <a href="{{ route('review.index', $review) }}">Regresar a index</a>
    
    <form action="{{ route('review.destroy', $review) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>