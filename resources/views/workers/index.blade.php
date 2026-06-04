@extends('layouts.app')

@section('content')

<form method="GET" class="flex gap-2 mb-4">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Buscar trabajador o rol..."
        class="border p-2 rounded flex-1">

    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded">

        Buscar

    </button>

    <a href="{{ route('workers.index') }}"
       class="bg-gray-500 text-white px-4 py-2 rounded">

        Limpiar

    </a>

</form>

<h1 class="text-2xl font-bold mb-5">Trabajadores</h1>

<a href="{{ route('workers.create') }}"
   class="bg-blue-500 text-white px-4 py-2 rounded">
   Nuevo trabajador
</a>

<table class="w-full mt-5 bg-white shadow">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Costo Hora</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($workers as $worker)
        <tr>
            <td>{{ $worker->name }}</td>
            <td>{{ $worker->role }}</td>
            <td>${{ $worker->hour_rate }}</td>
<td class="space-x-2">

<a
href="{{ route('workers.edit',$worker->id) }}"
class="bg-yellow-500 text-white px-3 py-1 rounded">

Editar

</a>

<form
method="POST"
action="{{ route('workers.destroy',$worker->id) }}"
class="inline">

@csrf
@method('DELETE')

<button
class="bg-red-500 text-white px-3 py-1 rounded">

Eliminar

</button>

</form>

</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection