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
            </tr>
        </thead>

        <tbody>
            @foreach($materials as $material)
                <tr>
                    <td>{{ $material->code }}</td>
                    <td>{{ $material->name }}</td>
                    <td>{{ $material->unit }}</td>

                    {{-- STOCK REAL (te explico abajo) --}}
                    <td>
                        {{ $material->stock ?? 0 }}
                    </td>

                    <td>{{ $material->base_cost }}</td>

                    <td>
    <span class="
        @if($material->status == 'critical') text-red-600
        @elseif($material->status == 'low') text-yellow-600
        @else text-green-600
        @endif
        font-bold
    ">
        {{ $material->stock }}
    </span>
</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection