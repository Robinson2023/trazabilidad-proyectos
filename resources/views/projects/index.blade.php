@extends('layouts.app')

@section('content')

<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Projects</h1>

    <a href="{{ route('projects.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">
        Nuevo Proyecto
    </a>
</div>

<div class="mb-4">
    <a href="/projects/global-dashboard"
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
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection