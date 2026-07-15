@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-2">

    <div>

        <h1 class="text-3xl font-bold">

            ➕ Agregar Producción

        </h1>
<br>
        <p class="text-gray-500">

            Proyecto:

            {{ $project->name }}

        </p>

    </div>

    <a
        href="{{ route('projects.show',$project) }}"
        class="bg-blue-700 text-black px-2 py-2 rounded-xl">

        ← Volver

    </a>

</div>
<br>
<form
method="POST"
action="{{ route('projects.production.store',$project) }}">

@csrf

<div class="bg-white rounded-2xl shadow-lg p-2 space-y-2">

    <div>

        <label class="font-semibold">

            Producto

        </label>

        <select
        name="product_id"
        class="w-full border rounded-lg p-2 mt-2">

            @foreach($products as $product)

                <option
                value="{{ $product->id }}">

                    {{ $product->name }}

                </option>

            @endforeach

        </select>

    </div>
<br>
    <div>

        <label class="font-semibold">

            Cantidad

        </label>

        <input
        type="number"
        name="quantity"
        value="1"
        min="1"
        class="w-full border rounded-lg p-2 mt-2">

    </div>
<br>
    <button
    class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-2 rounded-xl">

        Agregar Producción

    </button>

</div>

</form>

@endsection