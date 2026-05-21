<!DOCTYPE html>
<html>
<head>
    <title>Almacén</title>
    @vite('resources/css/app.css')
</head>

@extends('layouts.app')

@section('content')

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">Almacén - Movimientos</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/warehouse/movement" class="space-y-4">
        @csrf

        <!-- Barcode / Código -->
        <div>
            <label class="font-semibold">Código de material</label>
            <input type="text" name="material_code"
                   class="w-full border p-2 rounded"
                   placeholder="Escanear o escribir MAT-00001">
        </div>

        <!-- Tipo -->
        <div>
            <label class="font-semibold">Tipo de movimiento</label>
            <select name="type" class="w-full border p-2 rounded">
                <option value="out">Salida a proyecto</option>
                <option value="return">Devolución</option>
            </select>
        </div>

        <!-- Proyecto -->
        <div>
            <label class="font-semibold">Proyecto</label>
            <select name="project_id" class="w-full border p-2 rounded">
                <option value="">-- Seleccionar --</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Cantidad -->
        <div>
            <label class="font-semibold">Cantidad</label>
            <input type="number" step="0.01" name="quantity"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Notas -->
        <div>
            <label class="font-semibold">Notas</label>
            <textarea name="notes" class="w-full border p-2 rounded"></textarea>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
            Registrar movimiento
        </button>
    </form>

</div>
@endsection
</body>
</html>
