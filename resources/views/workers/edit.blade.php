@extends('layouts.app')

@section('content')

<h1>Editar Trabajador</h1>

<form method="POST" action="{{ route('workers.update', $worker->id) }}">
    @csrf
    @method('PUT')

    <input name="name" value="{{ $worker->name }}" class="border p-2 w-full mb-2">

    <input name="role" value="{{ $worker->role }}" class="border p-2 w-full mb-2">

    <input type="number" name="hour_rate"
           value="{{ $worker->hour_rate }}"
           class="border p-2 w-full mb-2">

    <button class="bg-green-500 text-white px-4 py-2">
        Actualizar
    </button>
</form>

@endsection