@extends('layouts.app')

@section('content')

<form method="GET" class="flex gap-2 mb-4">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Buscar..."
        class="border p-2 rounded flex-1">

    <button

        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded">

        Buscar

    </button>

    <select
    name="type"
    class="border rounded px-3 py-2">

    <option value="">Todos los movimientos</option>

    <option value="in"
        {{ request('type') == 'in' ? 'selected' : '' }}>
        Entrada
    </option>

    <option value="out"
        {{ request('type') == 'out' ? 'selected' : '' }}>
        Salida
    </option>

    <option value="return"
        {{ request('type') == 'return' ? 'selected' : '' }}>
        Devolución
    </option>

    <option value="adjust"
        {{ request('type') == 'adjust' ? 'selected' : '' }}>
        Ajuste
    </option>

</select>

    <a href="{{ route('material-log.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded">

        Limpiar

    </a>

</form>

<h1 class="text-2xl font-bold mb-6">
    Registro de Materiales
</h1>

<table class="w-full bg-white shadow rounded">

    <thead>

        <tr>

            <th class="p-3">Fecha</th>

            <th class="p-3">Proyecto</th>

            <th class="p-3">Movimiento</th>

            <th class="p-3">Material</th>

            <th class="p-3">Cantidad</th>

            <th class="p-3">Responsable</th>

            <th class="p-3">Observación</th>

        </tr>

    </thead>

    <tbody>

    @forelse($movements as $movement)

        <tr class="border-b">

            <td class="p-3">
                {{ $movement->created_at->format('Y-m-d') }}
            </td>

            <td class="p-3">
                {{ $movement->project?->name ?? '-' }}
            </td>

            <td class="px-4 py-3">

                @switch($movement->type)

                    @case('in')
                        <span class="text-green-600 font-semibold">
                            Entrada
                        </span>
                        @break

                    @case('out')
                        <span class="text-red-600 font-semibold">
                            Salida
                        </span>
                        @break

                    @case('return')
                        <span class="text-yellow-600 font-semibold">
                            Devolución
                        </span>
                        @break

                    @case('adjust')
                        <span class="text-blue-600 font-semibold">
                            Ajuste
                        </span>
                        @break

                    @default
                        {{ $movement->type }}

                @endswitch

            </td>

            <td class="p-3">
                {{ $movement->material?->name ?? '-' }}
            </td>

            <td class="p-3">
                {{ $movement->quantity }}
            </td>

            <td class="p-3">
                {{ $movement->worker?->name ?? '-' }}
            </td>

            <td class="p-3">
                {{ $movement->notes }}
            </td>

        </tr>

    @empty

        <tr>

            <td colspan="6"
                class="text-center p-4 text-gray-500">

                No hay movimientos registrados

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

@endsection