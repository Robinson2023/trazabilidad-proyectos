@extends('layouts.app')

@section('content')

<form method="GET" class="flex gap-2 mb-4">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Buscar proyecto, cliente o estado..."
        class="border p-2 rounded flex-1">

    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded">

        Buscar

    </button>

    <a href="{{ route('projects.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded">

        Limpiar

    </a>

</form>

<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Projects</h1>

    <a href="{{ route('projects.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">
        Nuevo Proyecto
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('projects.global-dashboard') }}"
       class="bg-green-500 text-white px-4 py-2 rounded">
        📊 Dashboard Gerencial
    </a>
</div>

<table class="w-full bg-white shadow rounded">

    <thead>
        <tr class="border-b">
            <th class="p-3">Nombre</th>
            <th class="p-3">Cliente</th>
            <th class="p-3">Estado</th>
            <th class="p-3">Acciones</th>
        </tr>
    </thead>

    <tbody>

        @foreach($projects as $project)

        <tr class="border-b">
            <td class="p-3">{{ $project->name }}</td>
            <td class="p-3">{{ $project->client }}</td>
            <td class="p-3">{{ $project->status }}</td>

            <td class="p-3 space-x-2">

                <a href="/projects/{{ $project->id }}/dashboard"
                   class="text-blue-500">
                    Dashboard
                </a>

                <a href="/projects/{{ $project->id }}/workers"
                   class="text-green-500">
                    Workers
                </a>

                <td>
        <a href="{{ route('projects.edit', $project->id) }}">
            Editar
        </a>

        <form method="POST" action="{{ route('projects.destroy', $project->id) }}">
            @csrf
            @method('DELETE')

            <button>Eliminar</button>
        </form>
    </td>

            </td>
        </tr>

        @endforeach

    </tbody>

</table>

@endsection