<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orden</title>
</head>
<body>

    <h1>Detalles de la Orden #{{ $order->id }}</h1>

    <h3>Usuario: {{ $order->user->name }}</h3>
    <h4>Status: {{ $order->status }}</h4>

<h3>Detalles de los Productos</h3>
<table border="1">
    <thead>
        <tr>
            <th>Nombre del Libro</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Imagen</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->libro->nombre }}</td>
                <td>{{ $item->precio_unitario }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>{{ $item->precio_unitario * $item->cantidad }}</td>
                <td>
                    @if($item->libro->imagen)
                        <img src="/storage/{{ $item->libro->imagen }}"  width="100">
                    @else
                        <p>No hay imagen</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br><br>
<form action="{{ route('order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta orden?')">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar Orden</button>
</form>

<br><br>

<a href="{{ route('order.index') }}">Volver al listado</a>

    
</body>
</html>