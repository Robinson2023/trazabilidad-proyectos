@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Editar Proyecto
</h1>

<form method="POST"
      action="{{ route('projects.update', $project) }}">

    @csrf
    @method('PUT')

 @extends('layouts.app')

@section('content')


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

<button class="bg-green-500 text-white px-4 py-2 rounded">
Actualizar Proyecto
</button>

</form>

@endsection