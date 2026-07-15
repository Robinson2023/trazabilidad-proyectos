@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Editar Proyecto
</h1>

<form method="POST"
      action="{{ route('projects.update', $project) }}">

    @csrf
    @method('PUT')


<div class="mb-4">
    <label>Nombre</label>
    <input name="name"
           value="{{ $project->name }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Cliente</label>
    <input name="client"
           value="{{ $project->client }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Presupuesto (Cotización)</label>
    <input type="number"
           step="0.01"
           name="budget"
           value="{{ $project->budget }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Costos administrativos</label>

    <input type="number"
           step="0.01"
           name="administrative_cost"
           value="{{ old('administrative_cost', $project->administrative_cost) }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Transporte</label>

    <input type="number"
           step="0.01"
           name="transport_cost"
           value="{{ old('administrative_cost', $project->administrative_cost) }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Alimentación</label>

    <input type="number"
           step="0.01"
           name="food_cost"
           value="{{ old('administrative_cost', $project->administrative_cost) }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Otros gastos</label>

    <input type="number"
           step="0.01"
           name="other_cost"
           value="{{ old('administrative_cost', $project->administrative_cost) }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Descripción otros</label>

    <textarea name="other_description"
              class="w-full border p-2 rounded">{{ old('other_description') }}</textarea>
</div>

<div class="mb-4">

    <label>Producto</label>

    @if($productionCreated)

<select
    class="w-full rounded-lg border-gray-300 bg-gray-100"
    disabled>

    @foreach($products as $product)

        <option
            value="{{ $product->id }}"
            {{ $project->product_id == $product->id ? 'selected' : '' }}>

            {{ $product->name }}

        </option>

    @endforeach

</select>

<input
    type="hidden"
    name="product_id"
    value="{{ $project->product_id }}">

<p class="text-sm text-red-600 mt-2">

    ⚠ El producto no puede cambiarse porque la producción ya fue creada.

</p>

@else

<select
    name="product_id"
    class="w-full rounded-lg border-gray-300">

    @foreach($products as $product)

        <option
            value="{{ $product->id }}"
            {{ $project->product_id == $product->id ? 'selected' : '' }}>

            {{ $product->name }}

        </option>

    @endforeach

</select>

@endif

</div>

<div class="mb-4">

    <label>Cantidad a fabricar</label>

    <input
        type="number"
        min="1"
        name="quantity"
        value="{{ old('quantity',1) }}"
        class="w-full border p-2 rounded"
        required>

</div>



<button class="bg-green-500 text-white px-4 py-2 rounded">
Actualizar Proyecto
</button>

</form>

@endsection