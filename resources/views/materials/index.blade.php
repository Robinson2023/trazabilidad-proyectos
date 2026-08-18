@extends('layouts.app')

@section('content')

<form method="GET" class="flex gap-2 mb-4">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Buscar por código o nombre..."
        class="border p-2 rounded flex-1">

    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded">

        Buscar

    </button>

    <a href="{{ route('materials.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded">

        Limpiar

    </a>

</form>

<div class="flex gap-2">

    <form action="{{ route('materials.recalculate') }}"
          method="POST">

        @csrf

        <button
            onclick="return confirm('¿Recalcular todos los costos unitarios?')"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">

            🔄 Recalcular Costos

        </button>

    </form>

    <a href="{{ route('materials.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">

        Nuevo Material

    </a>

</div>

<table class="w-full bg-white shadow rounded">

    <thead>
        <tr class="border-b">
            <th class="p-3">Nombre</th>
            <th class="p-3">Unidad</th>
            <th class="p-3">Compra</th>
            <th class="p-3">Costo unitario</th>
            <th class="p-3">Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($materials as $material)
        <tr class="border-b">

            <td class="p-3">{{ $material->name }}</td>
            <td class="p-3">{{ $material->unit }}</td>

            <td class="p-3">
                {{ $material->purchase_quantity }}
                {{ $material->purchase_unit }}/ ${{ $material->purchase_cost }}
            </td>

            <td class="p-3">
                ${{ number_format($material->base_cost, 2) }}
            </td>

            <td class="p-3 space-x-2">
                <button class="bg-red-500 text-white px-2 py-1 rounded">
                <a href="{{ route('materials.edit', $material->id) }}"
                   class="bg-yellow-500 text-white px-2 py-1 rounded">
                    Editar
                </a>

                <form method="POST"
                      action="{{ route('materials.destroy', $material->id) }}"
                      class="inline"
                      onsubmit="return confirm('¿Está seguro de eliminar este trabajador? Esta acción no se puede deshacer.')">

                    @csrf
                    @method('DELETE')

                    <button class="bg-red-500 text-white px-2 py-1 rounded">
                        Eliminar
                    </button>

                </form>

            </td>

        </tr>
        @endforeach
    </tbody>

</table>

@endsection