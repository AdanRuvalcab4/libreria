<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crea una orden</title>
</head>
<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <div id="books-container">
        <!-- Primer libro -->
        <div class="book-item">
            <label for="libro_id[]">Libro:</label>
            <select name="libro_id[]" required>
                @foreach($libros as $libro)
                    <option value="{{ $libro->id }}">{{ $libro->nombre }} - ${{ $libro->precio }}</option>
                @endforeach
            </select>

            <label for="cantidad[]">Cantidad:</label>
            <input type="number" name="cantidad[]" min="1" required>
        </div>
    </div>

    <button type="button" id="add-book">Agregar otro libro</button>
    <button type="submit">Crear Orden</button>
</form>

<script>
    // JavaScript para agregar más libros
    document.getElementById('add-book').addEventListener('click', function () {
        const container = document.getElementById('books-container');
        const newBook = document.querySelector('.book-item').cloneNode(true);
        container.appendChild(newBook);
    });
</script>