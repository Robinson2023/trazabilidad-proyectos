@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Crear Usuario
</h1>

<form method="POST"
      action="{{ route('users.store') }}"
      class="space-y-4">

    @csrf

    <input
        type="text"
        name="name"
        placeholder="Nombre"
        class="w-full border p-2 rounded">

    <input
        type="email"
        name="email"
        placeholder="Correo"
        class="w-full border p-2 rounded">

    <input
        type="password"
        name="password"
        placeholder="Contraseña"
        class="w-full border p-2 rounded">

    <select
        name="role"
        class="w-full border p-2 rounded">

        <option value="worker">Trabajador</option>
        <option value="warehouse">Almacén</option>
        <option value="supervisor">Supervisor</option>
        <option value="management">Gerencia</option>
        <option value="admin">Administrador</option>

    </select>

    <button
        class="bg-green-600 text-white px-4 py-2 rounded">

        Crear Usuario

    </button>

</form>

@endsection