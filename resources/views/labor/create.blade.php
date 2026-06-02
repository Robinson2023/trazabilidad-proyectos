@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Registro Diario de Horas
</h1>

@if ($errors->any())

<div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded mb-4">

    <h3 class="font-bold mb-2">
        ⚠ No se pudo guardar el registro
    </h3>

    <ul class="list-disc ml-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

</div>

@endif

@if(session('success'))

<div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded mb-4">

    ✅ {{ session('success') }}

</div>

@endif

<form method="POST"
      action="{{ route('labor.store') }}"
      class="bg-white p-6 rounded shadow">

    @csrf

    <div class="mb-4">
        <label class="block mb-2">
            Fecha
        </label>

        <input
            type="date"
            name="work_date"
            value="{{ date('Y-m-d') }}"
            class="w-full border rounded p-2"
            required>
    </div>

    <div class="mb-4">
        <label class="block mb-2">
            Trabajador
        </label>

        <select
            name="worker_id"
            class="w-full border rounded p-2"
            required>

            <option value="">
                Seleccionar trabajador
            </option>

            @foreach($workers as $worker)
                <option value="{{ $worker->id }}">
                    {{ $worker->name }}
                </option>
            @endforeach

        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-2">
            Proyecto
        </label>

        <select
            name="project_id"
            class="w-full border rounded p-2"
            required>

            <option value="">
                Seleccionar proyecto
            </option>

            @foreach($projects as $project)
                <option value="{{ $project->id }}">
                    {{ $project->name }}
                </option>
            @endforeach

        </select>
    </div>

    <div class="mb-4">
        <label class="block mb-2">
            Horas Trabajadas
        </label>

        <input
            type="number"
            step="0.25"
            min="0.25"
            name="hours"
            class="w-full border rounded p-2"
            required>
    </div>

    <div class="mb-4">
        <label class="block mb-2">
            Observaciones
        </label>

        <textarea
            name="notes"
            class="w-full border rounded p-2"
            rows="3"></textarea>
    </div>

    <button
        class="bg-blue-600 text-white px-4 py-2 rounded">

        Guardar Horas

    </button>

</form>

@endsection