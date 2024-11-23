<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ordenes</title>
</head>
<body>
    <h1>Ordenes</h1>

    <p>
        <a href="{{ route('order.create') }}">Crear una nueva orden </a>
    </p>

 
        <h1>Listado de Órdenes</h1>

        <table border = "1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <a href="{{ route('order.show', $order) }}">
                            {{ $order->id }}
                            </a>
                        </td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('order.edit', $order) }}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    
</body>
</html>