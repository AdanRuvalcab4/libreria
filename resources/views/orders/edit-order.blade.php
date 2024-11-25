<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Orden</title>
    <!-- Archivos de estilo -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"> <!-- Iconos -->

    <style>
        /* Estilos adicionales personalizados */
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        header {
            position: relative;
            background: url('{{ asset('images/book3.jpg') }}') no-repeat center center;
            background-size: cover;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            padding: 3rem 0;
            text-align: center;
        }

        header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Color negro con opacidad para superposición */
            z-index: 1;
        }

        header h1, header p {
            position: relative;
            z-index: 2;
        }

        header h1 {
            font-size: 3rem;
            font-weight: 600; /* Grosor moderado */
            color: #fff;
        }

        header p {
            font-size: 1.5rem;
        }

        .container {
            padding-top: 2rem;
        }

        .card {
            border: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #fff; /* Color base de la plantilla */
            color: #495057;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            box-shadow: none;
        }

        .btn-primary {
            background-color: #495057; /* Color base de la plantilla */
            border-color: #495057;
        }

        .alert {
            margin-top: 1rem;
        }

        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 300px); /* Ajusta según el tamaño del header y footer */
        }

        .card {
            max-width: 800px; /* Agrandado */
            width: 100%;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Encabezado Exclusivo (Header) -->
    <header>
        <div class="container">
            <h1><i class="bi bi-pencil-square"></i> Editar Orden</h1>
            <p class="lead">Modifica los detalles de tu orden</p>
        </div>
    </header>

    <div class="container py-5 form-wrapper">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-center">
                        
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('order.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <h2 class="mt-3">Editar Productos de la Orden</h2>
                            <div id="books-container">
                                @foreach($order->orderItems as $item)
                                    <div class="form-group book-item">
                                        <label for="libro_id[]" class="form-label">Libro:</label>
                                        <select name="libro_id[]" class="form-control" required>
                                            @foreach($libros as $libro)
                                                <option value="{{ $libro->id }}" {{ $libro->id == $item->libro_id ? 'selected' : '' }}>
                                                    {{ $libro->nombre }} - ${{ $libro->precio }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <label for="cantidad[]" class="form-label">Cantidad:</label>
                                        <input type="number" name="cantidad[]" class="form-control" min="1" value="{{ $item->cantidad }}" required>
                                        <input type="hidden" name="order_item_id[]" value="{{ $item->id }}">

                                        <!-- Casilla de verificación para eliminar -->
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" name="remove_item[]" value="{{ $item->id }}" id="remove_item_{{ $item->id }}">
                                            <label class="form-check-label" for="remove_item_{{ $item->id }}">
                                                Eliminar
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <h2 class="mt-4 text-center">Agregar Nuevos Productos</h2>
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary mb-3" id="add-book">Agregar otro libro</button>
                            </div>

                            <div id="new-books-container"></div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Actualizar Orden</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Archivos JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('add-book').addEventListener('click', function () {
            const container = document.getElementById('new-books-container');
            const newBook = `
                <div class="form-group new-book-item">
                    <label for="libro_id[]" class="form-label">Libro:</label>
                    <select name="libro_id[]" class="form-control" required>
                        @foreach($libros as $libro)
                            <option value="{{ $libro->id }}">{{ $libro->nombre }} - ${{ $libro->precio }}</option>
                        @endforeach
                    </select>
                    <label for="cantidad[]" class="form-label">Cantidad:</label>
                    <input type="number" name="cantidad[]" class="form-control" min="1" required>
                </div>`;
            container.insertAdjacentHTML('beforeend', newBook);
        });
    </script>
</body>
</html>
