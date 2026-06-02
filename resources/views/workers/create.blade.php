@extends('layouts.app')

@section('content')

<h1>Nuevo Trabajador</h1>

<form method="POST" action="{{ route('workers.store') }}">
    @csrf
        @method('PUT')
    <input name="name" placeholder="Nombre" class="border p-2 w-full mb-2">

    <input name="role" placeholder="Rol" class="border p-2 w-full mb-2">

    <input type="number" name="hour_rate" placeholder="Costo por hora"
           class="border p-2 w-full mb-2">

    <button class="bg-blue-500 text-white px-4 py-2">
        Guardar
    </button>
</form>

@endsection