@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">

Nuevo Producto

</h1>

<form method="POST"
      action="{{ route('products.store') }}"
      enctype="multipart/form-data"
      class="bg-white rounded-xl shadow p-6">

@csrf

<div class="mb-5">

<label class="font-semibold">

Nombre del producto

</label>

<input
type="text"
name="name"
class="w-full border rounded p-3"
required>

</div>

<div class="mb-5">

<label class="font-semibold">

Descripción

</label>

<textarea
name="description"
class="w-full border rounded p-3"
rows="4"></textarea>

</div>

<div class="mb-5">

<label class="font-semibold">

<div class="mb-4">

    <label class="block font-semibold mb-2">
        Imagen del producto
    </label>

    <input
        type="file"
        name="image"
        class="w-64 border border-gray-300 rounded-lg p-1 text-sm">

</div>

<div class="mb-6">

<label class="font-semibold">

Estado

</label>

<select
name="active"
class="w-full border rounded p-3">

<option value="1">

Activo

</option>

<option value="0">

Inactivo

</option>

</select>

</div>

<button
class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

Guardar Producto

</button>

</form>

@endsection