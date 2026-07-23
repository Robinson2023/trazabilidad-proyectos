@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold">

                ⚙ Configuración de Cilindros

            </h1>

            <p class="text-gray-500 mt-1">

                Parámetros para el semáforo de consumo.

            </p>

        </div>

        <a href="{{ route('gas-cylinders.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-xl">

            ← Volver

        </a>

    </div>

    @if(session('success'))

        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 rounded-xl p-4">

            {{ session('success') }}

        </div>

    @endif

    <form
        action="{{ route('gas-settings.update') }}"
        method="POST"
        class="bg-white rounded-2xl shadow-lg p-8">

        @csrf

        @method('PUT')

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="font-semibold">

                    Límite Amarillo (lbs)

                </label>

                <input
                    type="number"
                    step="0.01"
                    name="yellow_limit"
                    value="{{ old('yellow_limit',$setting->yellow_limit) }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">

                    Límite Rojo (lbs)

                </label>

                <input
                    type="number"
                    step="0.01"
                    name="red_limit"
                    value="{{ old('red_limit',$setting->red_limit) }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

        </div>

        <div class="mt-8 flex justify-end">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

                💾 Guardar Configuración

            </button>

        </div>

    </form>

</div>

@endsection