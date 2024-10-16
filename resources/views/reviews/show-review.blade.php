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
    <p>
        {{ $review->review }}
    </p>
    <p>
        <ul>
            <li>Fecha: {{ $review->fecha }}</li>
            <li>Usuario: {{ $review->id_user }}</li>
        </ul>
    </p>
    <hr>
    <a href="{{ route('review.edit', $review) }}">Editar</a>
    
    <form action="{{ route('review.destroy', $review) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>