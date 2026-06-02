@extends('layouts.app')

@section('content')


<div class="mb-4">
    <label>Nombre</label>
    <input name="name"
           value="{{ $project->name }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Cliente</label>
    <input name="client"
           value="{{ $project->client }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Presupuesto (Cotización)</label>
    <input type="number"
           step="0.01"
           name="budget"
           value="{{ $project->budget }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label>Horas estimadas</label>
    <input type="number"
           name="estimated_hours"
           value="{{ $project->estimated_hours }}"
           class="w-full border p-2 rounded">
</div>

<button class="bg-green-500 text-white px-4 py-2 rounded">
Actualizar Proyecto
</button>

</form>

@endsection