@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-5">

Nuevo Proyecto

</h1>

<form method="POST" action="{{ route('projects.store') }}"
      class="bg-white p-6 rounded shadow">

@csrf


<div class="mb-4">

<label>Nombre</label>
<input name="name"
       class="w-full border rounded p-2">

</div>

<div class="mb-4">

<label>Cliente</label>
<input name="client"
       class="w-full border rounded p-2">

</div>

<div class="mb-4">
<label>Presupuesto</label>

<input
type="number"
step="0.01"
name="budget"
class="w-full border rounded p-2">

</div>


<div class="mb-4">
    <label>Costos administrativos</label>

    <input type="number"
           step="0.01"
           name="administrative_cost"
           value="{{ old('administrative_cost', 0) }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Transporte</label>

    <input type="number"
           step="0.01"
           name="transport_cost"
           value="{{ old('transport_cost', 0) }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Alimentación</label>

    <input type="number"
           step="0.01"
           name="food_cost"
           value="{{ old('food_cost', 0) }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Otros gastos</label>

    <input type="number"
           step="0.01"
           name="other_cost"
           value="{{ old('other_cost', 0) }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Descripción otros</label>

    <textarea name="other_description"
              class="w-full border p-2 rounded">{{ old('other_description') }}</textarea>
</div>

<button class="bg-blue-500 text-white px-4 py-2 rounded">

Guardar

</button>

</form>

@endsection