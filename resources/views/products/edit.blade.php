@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
    Editar Producto
</h1>

@if ($errors->any())

<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">

    Debes diligenciar correctamente los campos obligatorios.

</div>

@endif

<form method="POST"
      action="{{ route('products.update', $product) }}"
      enctype="multipart/form-data"
      class="bg-white rounded-xl shadow p-6">

    @csrf
    @method('PUT')

    <div class="mb-5">

        <label class="font-semibold">
            Nombre del producto
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name) }}"
            class="w-full border rounded p-3"
            required>

    </div>

    <div class="mb-5">

        <label class="font-semibold">
            Descripción
        </label>

        <textarea
            name="description"
            rows="4"
            class="w-full border rounded p-3">{{ old('description', $product->description) }}</textarea>

    </div>

    @if($product->image)

    <div class="mb-5">

        <label class="font-semibold">
            Imagen actual
        </label>

        <img
            src="{{ asset('storage/products/'.$product->image) }}"
            class="w-64 rounded shadow mt-3">

    </div>

    @endif

    <div class="mb-5">

        <label class="font-semibold">
            Cambiar imagen
        </label>

        <input
            type="file"
            name="image"
            class="w-full border rounded p-3">

    </div>

    <div class="mb-5">

        <label class="font-semibold">
            Estado
        </label>

        <select
            name="active"
            class="w-full border rounded p-3">

            <option value="1"
                {{ $product->active ? 'selected' : '' }}>

                Activo

            </option>

            <option value="0"
                {{ !$product->active ? 'selected' : '' }}>

                Inactivo

            </option>

        </select>

    </div>

    <div class="flex gap-3 mt-8">

        <button
            type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">

            💾 Actualizar Producto

        </button>

        <a href="{{ route('products.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

            Cancelar

        </a>

    </div>

</form>

@endsection