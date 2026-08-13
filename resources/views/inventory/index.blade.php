@extends('layouts.app')

@section('content')


<form method="GET" class="flex gap-2 mb-4">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Buscar por código o material..."
        class="border p-2 rounded flex-1">

    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded">

        Buscar

    </button>

    <a href="{{ route('inventory.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded">

        Limpiar

    </a>

</form>

<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        
    <h1 class="text-2xl font-bold mb-6">Inventario en tiempo real</h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">

                <th>Código</td>
                <th>Material</th>
                <th>Unidad</th>
                <th>Stock</th>
                <th>Precio Unitario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

    @foreach($materials as $material)

        <tr class="border-b hover:bg-gray-50">

            <td class="p-3">
                {{ $material->code }}
            </td>

            <td class="p-3">
                {{ $material->name }}
            </td>

            <td class="p-3">
                {{ $material->unit }}
            </td>

            {{-- STOCK REAL --}}

            <td class="p-3 text-center font-semibold">
                {{ $material->stock ?? 0 }}
            </td>

            <td class="p-3">
                ${{ number_format($material->base_cost ?? 0, 0) }}
            </td>


            {{-- ESTADO --}}

            <td class="p-3 text-center">

                @if($material->status == 'ok')

                    <span class="bg-green-100 text-green-700
                                 px-3 py-1 rounded-full">

                        🟢 Disponible

                    </span>

                @elseif($material->status == 'warning')

                    <span class="bg-yellow-100 text-yellow-700
                                 px-3 py-1 rounded-full">

                        🟡 Stock Bajo

                    </span>

                @else

                    <span class="bg-red-100 text-red-700
                                 px-3 py-1 rounded-full">

                        🔴 Crítico

                    </span>

                @endif

            </td>


            {{-- ACCIONES --}}

            <td class="p-3 text-center">

                @if(auth()->user()->role === 'admin')

                    <a
                        href="{{ route('inventory.adjust', $material) }}"
                        class="inline-block
                               bg-yellow-500 hover:bg-yellow-600
                               text-white
                               px-3 py-2
                               rounded-lg
                               text-sm font-semibold">

                        ⚙️ Ajustar

                    </a>

                @endif

            </td>

        </tr>

    @endforeach

</tbody>

    </table>

</div>

@endsection