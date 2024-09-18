<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Mensajes</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Descripcion</th>
            
        </tr>
        @foreach ($libro as $libro)
            <tr>
                <td>{{ $libro->id }}</td>
                <td>{{ $libro->nombre }}</td>
                <td>{{ $libro->autor }}</td>
                <td>{{ $libro->precio }}</td>
                <td>{{ $libro->stock }}</td>
                <td>{{ $libro->descripcion }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>