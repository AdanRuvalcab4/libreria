<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Order</title>
</head>
<body>
    <h1>Editar Orden</h1>

    <form action="{{ route('order.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <h2>Editar Productos de la Orden</h2>
    <div id="books-container">
        @foreach($order->orderItems as $item)
            <div class="book-item">
                <label for="libro_id[]">Libro:</label>
                <select name="libro_id[]" required>
                    @foreach($libros as $libro)
                        <option value="{{ $libro->id }}" {{ $libro->id == $item->libro_id ? 'selected' : '' }}>
                            {{ $libro->nombre }} - ${{ $libro->precio }}
                        </option>
                    @endforeach
                </select>

                <label for="cantidad[]">Cantidad:</label>
                <input type="number" name="cantidad[]" min="1" value="{{ $item->cantidad }}" required>
                <input type="hidden" name="order_item_id[]" value="{{ $item->id }}">

                <!-- Casilla de verificación para eliminar -->
                <label for="remove_item_{{ $item->id }}">Eliminar:</label>
                <input type="checkbox" name="remove_item[]" value="{{ $item->id }}">
            </div>
        @endforeach
    </div>

    <h2>Agregar Nuevos Productos</h2>
    <button type="button" id="add-book">Agregar otro libro</button>

    <div id="new-books-container"></div>

    <button type="submit">Actualizar Orden</button>
</form>

<script>
    document.getElementById('add-book').addEventListener('click', function () {
        const container = document.getElementById('new-books-container');
        const newBook = `
            <div class="new-book-item">
                <label for="libro_id[]">Libro:</label>
                <select name="libro_id[]" required>
                    @foreach($libros as $libro)
                        <option value="{{ $libro->id }}">{{ $libro->nombre }} - ${{ $libro->precio }}</option>
                    @endforeach
                </select>
                <label for="cantidad[]">Cantidad:</label>
                <input type="number" name="cantidad[]" min="1" required>
            </div>`;
        container.insertAdjacentHTML('beforeend', newBook);
    });
</script>