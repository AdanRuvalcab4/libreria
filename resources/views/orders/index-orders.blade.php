@extends('layouts.app')

@section('title', 'Listado de Órdenes')

@section('content')
<div class="container py-5">
    <!-- Encabezado Principal -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-5 fw-bold text-primary">
                <i class="bi bi-cart"></i> Tus órdenes
            </h1>
            <p class="text-muted">Carrito de compras</p>
        </div>
    </div>

    <!-- Botón de Acción Principal -->
    <div class="row mb-4">
        <div class="col-12 text-end">
            <a href="{{ route('order.create') }}" class="btn btn-primary btn-lg shadow-sm w-100 w-md-auto">
                <i class="bi bi-plus-circle-fill"></i> Crear una nueva orden
            </a>
        </div>
    </div>

    <!-- Tarjeta Contenedora -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">
                        <i class="bi bi-journal-text"></i> Listado de Órdenes
                    </h3>
                </div>
                <div class="card-body p-0">
                    @if($orders->isEmpty())
                        <!-- Mensaje de Vacío -->
                        <div class="text-center p-5">
                            <i class="bi bi-folder-x fs-1 text-muted"></i>
                            <p class="text-muted fs-5">No hay órdenes registradas.</p>
                        </div>
                    @else
                        <!-- Tabla de Órdenes -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-uppercase" style="width: 10%;">ID</th>
                                        <th scope="col" class="text-uppercase" style="width: 25%;">Usuario</th>
                                        <th scope="col" class="text-uppercase" style="width: 20%;">Fecha</th>
                                        <th scope="col" class="text-uppercase" style="width: 20%;">Estado</th>
                                        <th scope="col" class="text-uppercase" style="width: 25%;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>
                                                <!-- Botón Editar -->
                                                <a href="{{ route('order.edit', $order) }}" class="btn btn-warning btn-sm w-100 mb-2">
                                                    <i class="bi bi-pencil-fill"></i> Editar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                @if($orders->isNotEmpty())
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
