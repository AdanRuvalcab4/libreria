@extends('layouts.app') <!-- Extiende la plantilla base -->

@section('title', 'Crear Nueva Orden') <!-- Título dinámico -->

@section('content')
    <h1 class="mb-4">Crear Nueva Orden</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cliente" class="form-label">Nombre del Cliente</label>
            <input type="text" name="cliente" id="cliente" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total de la Orden</label>
            <input type="number" name="total" id="total" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
@endsection
