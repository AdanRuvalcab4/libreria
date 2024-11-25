<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito de compras</title>
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
            background: url('{{ asset('images/book1.jpg') }}') no-repeat center center;
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
    </style>
</head>
<body>
    <!-- Encabezado Exclusivo (Header) -->
    <header>
        <div class="container">
            <h1><i class="bi bi-cart"></i>Ordena tu libro</h1>
            <p class="lead">Registra tu orden de libros</p>
        </div>
    </header>

    <div class="container py-5 form-wrapper">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-center">
                        <h1 class="mb-0"><i class="bi bi-cart"></i> Crear Orden</h1>
                    </div>
                    <div class="card-body p-4">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="libro_id" class="form-label">Selecciona un libro:</label>
                                <select name="libro_id[]" class="form-control" required>
                                    <option value="">-- Selecciona un libro --</option>
                                    @foreach($libros as $libro)
                                        <option value="{{ $libro->id }}">{{ $libro->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('libro_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" name="cantidad[]" class="form-control" min="1" value="{{ old('cantidad') }}" required>
                                @error('cantidad')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group text-center">
                                <input type="submit" value="Enviar" class="btn btn-primary">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Archivos JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
