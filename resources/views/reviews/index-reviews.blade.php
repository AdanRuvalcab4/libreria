<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Reviews</h1>

    <p>
        <a href="{{ route('review.create') }}">Agregar review</a>
    </p>

    <table border="1">
        <thead>
            <tr>
                <th>ID_Libro</th>
                <th>ID_Usuario</th>
                <th>Titulo</th>
                <th>Fecha</th>
                <th>Review</th>
                <th>Creación</th>
                <th>Edición</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->id_book }}</td>
                <td>{{ $review->id_user }}</td>
                <td>
                    <a href="{{ route('review.show', $review) }}">
                        {{ $review->titulo }}
                    </a>
                </td>
                <td>{{ $review->fecha }}</td>
                <td>{{ $review->review }}</td>
                <td>{{ $review->created_at }}</td>
                <td>{{ $review->updated_at }}</td>
                <td>
                    <a href="{{ route('review.edit', $review) }}">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>