@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-5">
    Nuevo Material
</h1>

<form method="POST"
      action="{{ route('materials.store') }}"
      class="bg-white p-6 rounded shadow">

    @csrf

    <!-- NOMBRE -->
    <div class="mb-4">
        <label>Nombre</label>
        <input name="name"
               class="w-full border rounded p-2"
               required>
    </div>

    <!-- UNIDAD -->
    <div class="mb-4">
        <label>Unidad</label>
        <select name="unit"
                class="w-full border rounded p-2"
                required>
            <option value="m">Metros</option>
            <option value="kg">Kilogramos</option>
            <option value="und">Unidad</option>
            <option value="litro">Litro</option>
        </select>
    </div>

    <hr class="my-4">

    <h2 class="text-lg font-semibold mb-3">
        Información de compra
    </h2>

    <!-- PRESENTACIÓN DE COMPRA -->
    <div class="mb-4">
        <label>Presentación de compra</label>
        <input name="purchase_unit"
               placeholder="Ej: barra, rollo, bulto"
               class="w-full border rounded p-2">
    </div>

        <div class="mb-4">
        <label>Cantidad por presentación</label>

        <input
            type="number"
            step="0.01"
            name="purchase_quantity"
            placeholder="Ej: 25"
            class="w-full border rounded p-2">
    </div>
    
    <!-- CANTIDAD POR PRESENTACIÓN -->
    <div class="mb-4">
        <label>Cantidad inicial</label>

        <input
            type="number"
            step="0.01"
            name="initial_quantity"
            value="0"
            class="w-full border rounded p-2">
    </div>

    <!-- COSTO POR PRESENTACIÓN -->
    <div class="mb-4">
        <label>Costo de la presentación</label>
        <input type="number"
               step="0.01"
               name="purchase_cost"
               placeholder="Ej: 48000"
               class="w-full border rounded p-2">
    </div>

    <div>
    <label class="font-semibold">
        Stock Amarillo
    </label>

    <input
        type="number"
        step="0.01"
        name="warning_stock"
        value="{{ old('warning_stock',25) }}"
        class="w-full border rounded-lg p-3">
</div>

<div>
    <label class="font-semibold">
        Stock Crítico
    </label>

    <input
        type="number"
        step="0.01"
        name="critical_stock"
        value="{{ old('critical_stock',10) }}"
        class="w-full border rounded-lg p-3">
</div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Guardar
    </button>

</form>

@endsection