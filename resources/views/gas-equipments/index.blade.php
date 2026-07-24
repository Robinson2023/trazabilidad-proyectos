@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold">

            🟢 Equipos para Cilindros

        </h1>
<br>
        <p class="text-gray-500">

            Administración de equipos consumidores de gases.

        </p>

    </div>
<br>
    <a
        href="{{ route('gas-equipments.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">

        ➕ Nuevo Equipo

    </a>

</div>
<br>
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

<table class="w-full">

<thead class="bg-slate-800 text-white">

<tr>

<th class="p-4 text-left">

Nombre

</th>

<th class="p-4">

Marca

</th>

<th class="p-4">

Modelo

</th>

<th class="px-4 py-3">

Responsable

</th>

<th class="p-4">

Estado

</th>

<th class="p-4">

Acciones

</th>

</tr>

</thead>

<tbody>

@forelse($equipments as $equipment)

<tr class="border-b hover:bg-gray-50">

<td class="p-4 font-semibold">

{{ $equipment->name }}

</td>

<td class="text-center">

{{ $equipment->brand }}

</td>

<td class="text-center">

{{ $equipment->model }}

</td>

<td class="px-4 py-3">

    {{ $equipment->worker?->name ?? 'Sin asignar' }}

</td>

<td class="text-center">

@if($equipment->active)

<span class="text-green-600 font-bold">

🟢 Activo

</span>

@else

<span class="text-red-600 font-bold">

🔴 Inactivo

</span>

@endif

<td class="text-center space-x-2">

    <a
        href="{{ route('gas-equipments.edit',$equipment) }}"
        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">

        ✏️ Editar

    </a>

    <form
        action="{{ route('gas-equipments.destroy',$equipment) }}"
        method="POST"
        class="inline">

        @csrf
        @method('DELETE')

        <button
            onclick="return confirm('¿Eliminar este equipo?')"
            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">

            🗑 Eliminar

        </button>

    </form>

</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center py-8 text-gray-500">

No existen equipos registrados.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection