@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-5">

Nuevo Material

</h1>

<form
method="POST"
action="{{ route('materials.store') }}"
class="bg-white p-6 rounded shadow">

@csrf

<div class="mb-4">

<label>Nombre</label>

<input
name="name"
class="w-full border rounded p-2">

</div>

<div class="mb-4">

<label>Unidad</label>

<select
name="unit"
class="w-full border rounded p-2">

<option value="m">Metros</option>
<option value="kg">Kilogramos</option>
<option value="und">Unidad</option>
<option value="litro">Litro</option>

</select>

</div>

<div class="mb-4">

<label>Costo Base</label>

<input
type="number"
name="base_cost"
class="w-full border rounded p-2">

</div>

<button
class="bg-blue-500 text-white px-4 py-2 rounded">

Guardar

</button>

</form>

@endsection