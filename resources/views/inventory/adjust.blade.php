@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- CABECERA --}}

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                ⚙️ Ajustar Inventario
            </h1>

            <p class="text-gray-500 mt-1">
                Corrección del inventario físico.
            </p>

        </div>

        <a
            href="{{ route('inventory.index') }}"
            class="bg-gray-500 hover:bg-gray-600
                   text-white px-4 py-2 rounded-lg">

            ← Volver

        </a>

    </div>


    {{-- INFORMACIÓN DEL MATERIAL --}}

    <div class="bg-white rounded-2xl shadow-md
                border border-gray-200 p-6 mb-6">

        <p class="text-xs uppercase
                  tracking-wide text-gray-400">

            Material

        </p>

        <h2 class="text-xl font-bold text-gray-800 mt-1">

            {{ $material->name }}

        </h2>

        <p class="text-sm text-gray-500 mt-1">

            Código: {{ $material->code }}

        </p>

    </div>


    {{-- FORMULARIO --}}

    <form
        method="POST"
        action="{{ route('inventory.adjust.store', $material) }}"
        class="bg-white rounded-2xl shadow-md
               border border-gray-200 p-6">

        @csrf


        {{-- STOCK ACTUAL --}}

        <div class="mb-6">

            <label class="block text-sm
                          font-semibold text-gray-600">

                Stock registrado actualmente

            </label>

            <div class="mt-2 bg-gray-100
                        rounded-lg p-4
                        text-2xl font-bold
                        text-gray-800">

                {{ number_format($stock, 2) }}

                <span class="text-sm text-gray-500">
                    {{ $material->unit }}
                </span>

            </div>

        </div>


        {{-- NUEVO STOCK --}}

        <div class="mb-6">

            <label class="block text-sm
                          font-semibold text-gray-600">

                Stock físico real

            </label>

            <input
                type="number"
                name="new_stock"
                step="0.01"
                min="0"
                required
                class="w-full mt-2
                       border border-gray-300
                       rounded-lg p-3
                       text-lg"
                placeholder="Ingrese la cantidad física">

        </div>


        {{-- MOTIVO --}}

        <div class="mb-6">

            <label class="block text-sm
                          font-semibold text-gray-600">

                Motivo del ajuste

            </label>

            <textarea
                name="notes"
                rows="4"
                required
                class="w-full mt-2
                       border border-gray-300
                       rounded-lg p-3"
                placeholder="Explique el motivo del ajuste..."></textarea>

        </div>


        {{-- BOTÓN --}}

        <div class="flex justify-end">

            <button
                type="submit"
                class="bg-yellow-500
                       hover:bg-yellow-600
                       text-white px-6 py-3
                       rounded-xl shadow
                       font-semibold">

                ⚙️ Aplicar Ajuste

            </button>

        </div>

    </form>

</div>

@endsection