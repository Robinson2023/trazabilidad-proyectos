<!DOCTYPE html>
<html>
<head>
    <title>Inventario</title>
    @vite('resources/css/app.css')
</head>

@extends('layouts.app')

@section('content')
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">Inventario en tiempo real</h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th>Codigo</th>
                <th>Material</th>
                <th>Cantidad</th>

            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $inv)
            <tr class="border-t">
                <td>{{ $inv->material->code }}</td>
                <td>{{ $inv->material->name }}</td>
                <td>{{ $inv->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="mt-10 p-4 bg-gray-50 border rounded">

    <h2 class="text-xl font-bold mb-4">Registrar movimiento (Almacén)</h2>

    <form method="POST" action="/warehouse/movement" class="space-y-4">
        @csrf

        <!-- Código de barras -->
        <div>
            <label>Código de material</label>
                <input type="text"
                    id="barcode"
                    name="material_code"
                    class="w-full border p-2 rounded"
                    placeholder="Escanear MAT-00001">
        </div>

        <div id="material-info" class="mt-2 text-green-700 font-bold"></div>
        <!-- Tipo -->
        <div>
            <label>Tipo</label>
            <select name="type" class="w-full border p-2 rounded">
                <option value="out">Salida</option>
                <option value="return">Devolución</option>
            </select>
        </div>

        <!-- Proyecto -->
        <div>
            <label>Proyecto</label>
            <select name="project_id" class="w-full border p-2 rounded">
                <option value="">Seleccionar</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Cantidad -->
        <div>
            <label>Cantidad</label>
            <input type="number" step="0.01" name="quantity"
                   class="w-full border p-2 rounded">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
            Registrar movimiento
        </button>
    </form>

</div>
@endsection
<script>
document.getElementById('barcode').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();

        let code = this.value;

        fetch(`/material/${code}`)
            .then(res => res.json())
            .then(data => {

                if (!data.found) {
                    document.getElementById('material-info').innerText =
                        "❌ Material no encontrado";
                    return;
                }

                document.getElementById('material-info').innerText =
                    "📦 " + data.material.name + " (" + data.material.code + ")";

            });
    }
});
</script>

</body>
</html>