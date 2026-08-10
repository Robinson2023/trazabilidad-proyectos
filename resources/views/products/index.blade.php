@extends('layouts.app')

@section('content')

<div class="mb-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                📦 Biblioteca de Productos
            </h1>

            <p class="text-gray-500 mt-1">
                Catálogo de productos de fabricación
            </p>
        </div>

        <a
            href="{{ route('products.create') }}"
            class="bg-blue-600 hover:bg-blue-700
                   text-white px-5 py-3 rounded-lg
                   font-semibold shadow">

            ➕ Nuevo Producto

        </a>

    </div>

</div>


@if(session('success'))

    <div class="bg-green-100 border border-green-300
                text-green-800 px-4 py-3 rounded-lg mb-6">

        {{ session('success') }}

    </div>

@endif


@if($products->isEmpty())

    <div class="bg-white rounded-xl shadow p-10 text-center">

        <div class="text-6xl mb-4">
            📦
        </div>

        <h2 class="text-2xl font-bold text-gray-800">
            No existen productos registrados
        </h2>

        <p class="text-gray-500 mt-3">
            Cree el primer producto para comenzar.
        </p>

    </div>

@else

    {{-- LISTADO HORIZONTAL DE PRODUCTOS --}}

    <div class="space-y-4">

        @foreach($products as $product)

            <x-product-card :product="$product"/>

        @endforeach

    </div>

@endif

@endsection