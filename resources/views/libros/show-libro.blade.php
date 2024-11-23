<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libro</title>
</head>
<body>
    <h1>{{ $libro->nombre }}</h1>
    <p>
        {{ $libro->autor }}
    </p>
    <p>
        <ul>
            <li>Stock: {{ $libro->stock }}</li>
            <li>Precio: {{ $libro->precio_unitario }}</li>
        </ul>
    </p>
    <p>
        {{ $libro->descripcion }}
    </p>
    <hr>
    <a href="{{ route('libro.edit', $libro) }}">Editar</a>
    
    <form action="{{ route('libro.destroy', $libro) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Eliminar">
    </form>
</body>
</html>