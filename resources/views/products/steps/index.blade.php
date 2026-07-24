@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold">
                ⚙ Proceso de Fabricación
            </h1>

            <p class="text-gray-500 mt-1">
                Producto:
                <strong>{{ $product->name }}</strong>
            </p>

        </div>

        <a href="{{ route('products.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

            ← Volver

        </a>

    </div>


    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded mb-5">

            {{ session('success') }}

        </div>

    @endif


    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form method="POST"
              action="{{ route('products.steps.store',$product) }}">

            @csrf

            <div class="flex gap-3">

                <input
                    type="text"
                    name="name"
                    placeholder="Nombre de la nueva etapa..."
                    class="flex-1 border rounded p-3"
                    required>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 rounded">

                    ➕ Agregar

                </button>

            </div>

        </form>
<br>
        <form
            action="{{ route('products.steps.sync', $product) }}"
            method="POST"
            class="inline">

            @csrf

            <button
                type="submit"
                onclick="return confirm('¿Desea sincronizar los procesos con todas las unidades de producción existentes?')"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">

                🔄 Sincronizar Producción

            </button>

        </form>

    </div>


    <div class="bg-white rounded-xl shadow">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-3 text-center">Orden</th>

                    <th class="p-3">Proceso</th>

                    <th class="p-3 text-center">Acciones</th>

                </tr>

            </thead>

            <tbody>

            @forelse($steps as $step)

                <tr class="border-b">

                    <td class="text-center font-bold">

                        {{ $step->order }}

                    </td>

                    <td>

                        {{ $step->name }}

                    </td>

                    <td class="text-center">

                        <a href="{{ route('products.steps.edit',[$product,$step]) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

                            Editar

                        </a>

                        <form
                            action="{{ route('products.steps.destroy',[$product,$step]) }}"
                            method="POST"
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('¿Eliminar esta etapa?')"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                Eliminar

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3"
                        class="text-center p-6 text-gray-500">

                        Este producto aún no tiene procesos registrados.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection