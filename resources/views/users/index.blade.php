@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Administración de Usuarios
</h1>

<div class="mb-4">

    <a href="{{ route('users.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">

        ➕ Nuevo Usuario

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-3 rounded mb-4">

    {{ session('success') }}

</div>

@endif

<table class="w-full bg-white shadow rounded">

    <thead>

        <tr>

            <th class="p-3">Nombre</th>
            <th class="p-3">Email</th>
            <th class="p-3">Rol</th>
            <th class="p-3">Acción</th>

        </tr>

    </thead>

    <tbody>

@foreach($users as $user)

<tr class="border-b">

    <td class="p-3">
        {{ $user->name }}
    </td>

    <td class="p-3">
        {{ $user->email }}
    </td>

    <form
        method="POST"
        action="{{ route('users.role', $user) }}">

        @csrf
        @method('PUT')

        <td class="p-3">

            <select
                name="role"
                class="border p-2 rounded">

                <option value="admin"
                    @selected($user->role == 'admin')>
                    Admin
                </option>

                <option value="management"
                    @selected($user->role == 'management')>
                    Gerencia
                </option>

                <option value="warehouse"
                    @selected($user->role == 'warehouse')>
                    Almacén
                </option>

                <option value="supervisor"
                    @selected($user->role == 'supervisor')>
                    Supervisor
                </option>

                <option value="worker"
                    @selected($user->role == 'worker')>
                    Trabajador
                </option>

            </select>

        </td>

        <td class="p-3">

            <button
                type="submit"
                class="bg-blue-600 text-white px-3 py-1 rounded">

                Guardar

            </button>

        </td>

    </form>

</tr>

@endforeach

    </tbody>

</table>

@endsection