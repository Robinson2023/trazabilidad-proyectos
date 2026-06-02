@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-5">
    Editar Material
</h1>

<form method="POST"
      action="{{ route('materials.update', $material->id) }}"
      class="bg-white p-6 rounded shadow">

    @csrf
    @method('PUT')

    <!-- NOMBRE -->
    <div class="mb-4">
        <label>Nombre</label>
        <input name="name"
               value="{{ $material->name }}"
               class="w-full border rounded p-2">
    </div>

    <!-- UNIDAD -->
    <div class="mb-4">
        <label>Unidad</label>
        <select name="unit"
                class="w-full border rounded p-2">

            <option value="m" {{ $material->unit=='m'?'selected':'' }}>Metros</option>
            <option value="kg" {{ $material->unit=='kg'?'selected':'' }}>Kilogramos</option>
            <option value="und" {{ $material->unit=='und'?'selected':'' }}>Unidad</option>
            <option value="litro" {{ $material->unit=='litro'?'selected':'' }}>Litro</option>

        </select>
    </div>

    <hr class="my-4">

    <h2 class="text-lg font-semibold mb-3">
        Compra
    </h2>

    <div class="mb-4">
        <label>Presentación</label>
        <input name="purchase_unit"
               value="{{ $material->purchase_unit }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
    <label>Cantidad inicial</label>

    <input
        type="number"
        step="0.01"
        name="initial_quantity"
        value="{{ old('initial_quantity', $material->initial_quantity ?? 0) }}"
        class="w-full border rounded p-2">
</div>

    <div class="mb-4">
        <label>Costo</label>
        <input name="purchase_cost"
               value="{{ $material->purchase_cost }}"
               class="w-full border rounded p-2">
    </div>

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Actualizar
    </button>

</form>

@endsection