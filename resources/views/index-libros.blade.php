<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Libros</title>
</head>
<body>
    <h1> Libros</h1>
    <p>
        <a href="{{ route('libro.create') }}">Agregar libro</a>
    </p>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Descripcion</th>
            <th>Acciones</th>
            
        </tr>
        <tbody>
            @foreach ($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td>
                    <a href="{{ route('libro.show', $libro) }}">
                            {{ $libro->nombre }}
                        </a>
                    </td>    
                    <td>{{ $libro->autor }}</td>
                    <td>{{ $libro->precio }}</td>
                    <td>{{ $libro->stock }}</td>
                    <td>{{ $libro->descripcion }}</td>
                    <td>
                    <a href="{{ route('libro.edit', $libro) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>