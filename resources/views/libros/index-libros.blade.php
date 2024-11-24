@extends('layouts.app')

@section('title', 'Listado de Libros')

@section('content')
<div class="container py-5">
    <!-- Encabezado Principal -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-5 fw-bold text-primary">
                <i class="bi bi-book"></i> Gestión de Libros
            </h1>
            <p class="text-muted">Administra la colección de libros de manera eficiente.</p>
        </div>
    </div>

    <!-- Botón de Acción Principal -->
    <div class="row mb-4">
        <div class="col-12 text-end">
            <a href="{{ route('libros.create') }}" class="btn btn-primary btn-lg shadow-sm w-100 w-md-auto">
                <i class="bi bi-plus-circle-fill"></i> Agregar Libro
            </a>
        </div>
    </div>

    <!-- Tarjeta Contenedora -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">
                        <i class="bi bi-journal-text"></i> Listado de Libros
                    </h3>
                </div>
                <div class="card-body p-0">
                    @if($libros->isEmpty())
                        <!-- Mensaje de Vacío -->
                        <div class="text-center p-5">
                            <i class="bi bi-folder-x fs-1 text-muted"></i>
                            <p class="text-muted fs-5">No hay libros registrados.</p>
                        </div>
                    @else
                        <!-- Tabla de Libros -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-uppercase" style="width: 10%;">#</th>
                                        <th scope="col" class="text-uppercase" style="width: 45%;">Título</th>
                                        <th scope="col" class="text-uppercase" style="width: 35%;">Autor</th>
                                        <th scope="col" class="text-uppercase" style="width: 10%;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($libros as $libro)
                                        <tr>
                                            <td class="fw-bold">{{ $libro->id }}</td>
                                            <td class="text-truncate" style="max-width: 250px;">{{ $libro->titulo }}</td>
                                            <td class="text-truncate" style="max-width: 250px;">{{ $libro->autor }}</td>
                                            <td>
                                                <!-- Botón Editar -->
                                                <a href="{{ route('edit-libro', $libro->id) }}" class="btn btn-warning btn-sm w-100 mb-2">
                                                    <i class="bi bi-pencil-fill"></i> Editar
                                                </a>

                                                <!-- Botón Eliminar -->
                                                <form action="{{ route('libros.destroy', $libro->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                                        <i class="bi bi-trash-fill"></i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @if($libros->isNotEmpty())
                    <!-- Paginación -->
                    <div class="card-footer bg-light text-end" style="height: 75px;">
                        <!-- Puedes añadir elementos dentro de esta sección según lo necesites -->
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
