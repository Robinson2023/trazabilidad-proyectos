@extends('layouts.app')

@section('content')

<form method="GET" class="flex gap-2 mb-4">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Buscar trabajador o proyecto..."
        class="border p-2 rounded flex-1">

    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded">

        Buscar

    </button>

    <a href="{{ route('labor.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded">

        Limpiar

    </a>

</form>

<div class="flex justify-between mb-6">

    <h1 class="text-2xl font-bold">
        Registro de Horas
    </h1>

    <a href="{{ route('labor.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">

        Nuevo Registro

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>

@endif

<table class="w-full bg-white shadow rounded">

    <thead>

        <tr class="bg-gray-200">

            <th class="p-3">Fecha</th>

            <th class="p-3">Trabajador</th>

            <th class="p-3">Proyecto</th>

            <th class="p-3">Horas</th>

            <th class="p-3">Observaciones</th>

        </tr>

    </thead>

    <tbody>

    @forelse($entries as $entry)

        <tr class="border-b">

            <td class="p-3">
                {{ $entry->work_date }}
            </td>

            <td class="p-3">
                {{ $entry->worker->name }}
            </td>

            <td class="p-3">
                {{ $entry->project->name }}
            </td>

            <td class="p-3 font-bold">
                {{ $entry->hours }}
            </td>

            <td class="p-3">
                {{ $entry->notes }}
            </td>

        </tr>

    @empty

        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">
                No existen registros todavía
            </td>
        </tr>

    @endforelse

    </tbody>

</table>

@endsection