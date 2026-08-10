@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">

Registrar consumo

</h1>

<div class="bg-white shadow rounded-lg p-6">

<form method="POST"
      action="{{ route('gas-consumptions.store',$gasCylinder) }}">

@csrf

<div class="mb-4">

<label>Cilindro</label>

<input
    class="w-full border rounded p-2 bg-gray-100"
    value="{{ $gasCylinder->number }}"
    readonly>

</div>

<div class="mb-4">

<label>Proyecto</label>

<select
    name="project_id"
    class="w-full border rounded p-2">

@foreach($projects as $project)

<option value="{{ $project->id }}">

{{ $project->name }}

</option>

@endforeach

</select>

</div>

<div class="mb-4">

<label>Responsable</label>

<select
    name="worker_id"
    class="w-full border rounded p-2">

@foreach($workers as $worker)

<option value="{{ $worker->id }}">

{{ $worker->name }}

</option>

@endforeach

</select>

</div>

<div class="mb-4">

<label>Equipo</label>

<input
    class="w-full border rounded p-2 bg-gray-100"
    value="{{ $gasCylinder->equipment?->name ?? '🏭 Almacén — Sin equipo asignado' }}"
    readonly>

</div>

<div class="grid grid-cols-2 gap-4">

<div>

<label>Libras actuales</label>

<input
    class="w-full border rounded p-2 bg-gray-100"
    value="{{ $gasCylinder->current_lbs }}"
    readonly>

</div>

<div>

<label>Libras finales</label>

<input
    type="number"
    step="0.01"
    name="end_lbs"
    class="w-full border rounded p-2"
    required>

</div>

</div>

<div class="mt-4">

<label>Observaciones</label>

<textarea
    name="notes"
    class="w-full border rounded p-2"></textarea>

</div>

<button
    class="mt-6 bg-blue-600 text-white px-4 py-2 rounded">

Guardar consumo

</button>

</form>

</div>

@endsection