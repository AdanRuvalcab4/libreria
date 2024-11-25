@extends('layouts.app')

@section('title', 'Listado de Reseñas')

@section('content')
<div class="container py-5">
    <!-- Encabezado Principal -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-5 fw-bold text-primary">Listado de Reseñas</h1>
        </div>
    </div>

    <!-- Botón de Acción Principal -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <a href="{{ route('reviews.create') }}" class="btn btn-primary btn-lg shadow-sm w-100 w-md-auto">
                Agregar Nueva Reseña
            </a>
        </div>
    </div>

    <!-- Tabla de Reseñas -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Listado de Reseñas</h3>
                </div>
                <div class="card-body p-0 text-center">
                    @if($reviews->isEmpty())
                        <div class="text-center p-5">
                            <i class="bi bi-folder-x fs-1 text-muted"></i>
                            <p class="text-muted fs-5">No hay reseñas registradas.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0 mx-auto" style="width: 95%;">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-uppercase" style="width: 5%;">#</th>
                                        <th scope="col" class="text-uppercase" style="width: 20%;">Producto</th>
                                        <th scope="col" class="text-uppercase" style="width: 20%;">Usuario</th>
                                        <th scope="col" class="text-uppercase" style="width: 15%;">Calificación</th>
                                        <th scope="col" class="text-uppercase" style="width: 25%;">Comentario</th>
                                        <th scope="col" class="text-uppercase" style="width: 15%;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $review->id }}</td>
                                            <td>{{ $review->libro->nombre }}</td>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ $review->calificacion }}</td>
                                            <td>{{ $review->review }}</td>
                                            <td>
                                                <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning btn-sm w-100 mb-2">
                                                    <i class="bi bi-pencil-fill"></i> Editar
                                                </a>
                                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline w-100">
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
                @if($reviews->isNotEmpty())
                    <div class="card-footer bg-light text-end" style="height: 75px;">
                        <!-- Puedes añadir elementos dentro de esta sección según lo necesites -->
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
