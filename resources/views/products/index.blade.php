@extends('layouts.app')

@section('content')

{{-- CABECERA --}}
<div class="justify-between items-center border-b pb-5 mb-8">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            📦 Biblioteca de Productos
        </h1>
<br>
        <p class="text-gray-500 mt-1">
            Catálogo de productos de fabricación
        </p>

    </div>
<br>
    <a href="{{ route('products.create') }}"
       class="bg-blue-500 hover:bg-blue-700 text-black px-2 py-2 rounded-xl shadow">

        ➕ Nuevo Producto

    </a>

</div>

<br>
<br>

@if(session('success'))

<div class="mb-6 rounded-xl bg-green-50 border border-green-200 text-green-500 p-2">

    {{ session('success') }}

</div>

@endif


@if($products->isEmpty())

<div class="bg-white rounded-xl shadow-lg p-10 text-center">

    <div class="text-6xl mb-4">

        📦

    </div>

    <h2 class="text-2xl font-bold">

        No existen productos registrados

    </h2>

    <p class="text-gray-500 mt-3">

        Cree el primer producto para comenzar.

    </p>

</div>

@else

<div class="flex flex-wrap justify-center gap-2">

    @foreach($products as $product)

        <x-product-card :product="$product"/>

    @endforeach

</div>

@endif

@endsection