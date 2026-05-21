@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-5">
Editar Material
</h1>

<form
method="POST"
action="{{ route('materials.update', $material->id) }}"
class="bg-white p-6 rounded shadow">

@csrf
@method('PUT')

<div class="mb-4">

<label>Nombre</label>

<input
name="name"
value="{{ $material->name }}"
class="w-full border rounded p-2">

</div>

<div class="mb-4">

<label>Unidad</label>

<select
name="unit"
class="w-full border rounded p-2">

<option value="m" {{ $material->unit == 'm' ? 'selected' : '' }}>Metros</option>
<option value="kg" {{ $material->unit == 'kg' ? 'selected' : '' }}>Kilogramos</option>
<option value="und" {{ $material->unit == 'und' ? 'selected' : '' }}>Unidad</option>
<option value="litro" {{ $material->unit == 'litro' ? 'selected' : '' }}>Litro</option>

</select>

</div>

<div class="mb-4">

<label>Costo Base</label>

<input
type="number"
name="base_cost"
value="{{ $material->base_cost }}"
class="w-full border rounded p-2">

</div>

<button
class="bg-green-500 text-white px-4 py-2 rounded">

Actualizar

</button>

</form>

@endsection