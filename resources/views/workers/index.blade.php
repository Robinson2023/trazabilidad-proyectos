@extends('layouts.app')

@section('content')

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
            <td>
                <a href="{{ route('workers.edit', $worker->id) }}">Editar</a>

                <form method="POST"
                      action="{{ route('workers.destroy', $worker->id) }}"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button>Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection