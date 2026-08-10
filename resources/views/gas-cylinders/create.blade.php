@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- CABECERA --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold">

                🟢 Nuevo Cilindro

            </h1>

            <p class="text-gray-500 mt-1">

                Registro de cilindros de gases industriales.

            </p>

        </div>

        <a href="{{ route('gas-cylinders.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-xl shadow">

            ← Volver

        </a>

    </div>

    {{-- ERRORES --}}
    @if($errors->any())

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-xl p-4">

            <ul class="list-disc ml-6">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- FORMULARIO --}}
    <form
        action="{{ route('gas-cylinders.store') }}"
        method="POST"
        class="bg-white rounded-2xl shadow-lg p-8">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="font-semibold">

                    Número del Cilindro

                </label>

                <input
                    type="text"
                    name="number"
                    value="{{ old('number') }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">

                    Tipo de Gas

                </label>

                <select
                    name="gas_type"
                    class="w-full mt-2 border rounded-lg p-3">

                    <option value="">Seleccione...</option>

                    <option>Argón</option>

                    <option>Agamix</option>

                    <option>Oxígeno</option>

                    <option>Acetileno</option>

                </select>

            </div>

            <div>

                <label class="font-semibold">
                    Equipo
                </label>

                <select
                    name="equipment_id"
                    class="w-full mt-2 border rounded-lg p-3">

                    <option value="">
                        🏭 Sin asignar — Almacén
                    </option>

                    @foreach($equipments as $equipment)

                        <option
                            value="{{ $equipment->id }}"
                            {{ old('equipment_id') == $equipment->id ? 'selected' : '' }}>

                            {{ $equipment->code }} - {{ $equipment->name }}

                        </option>

                    @endforeach

                </select>

                <p class="text-xs text-gray-500 mt-1">
                    Déjelo sin asignar si el cilindro queda almacenado.
                </p>

            </div>

            <div>

                <label class="font-semibold">
                    Responsable
                </label>

                <select
                    name="worker_id"
                    class="w-full mt-2 border rounded-lg p-3">

                    <option value="">
                        👤 Sin asignar
                    </option>

                    @foreach($workers as $worker)

                        <option
                            value="{{ $worker->id }}"
                            {{ old('worker_id') == $worker->id ? 'selected' : '' }}>

                            {{ $worker->name }}

                        </option>

                    @endforeach

                </select>

                <p class="text-xs text-gray-500 mt-1">
                    Solo se asigna cuando el cilindro entra en operación.
                </p>

            </div>

            <div>

                <label class="font-semibold">

                    Fecha de Inicio

                </label>

                <input
                    type="date"
                    name="start_date"
                    value="{{ old('start_date', date('Y-m-d')) }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">

                    Libras Iniciales

                </label>

                <input
                    type="number"
                    step="0.01"
                    name="initial_lbs"
                    value="{{ old('initial_lbs') }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

        </div>

        <div class="mt-6">

            <label class="font-semibold">

                Observaciones

            </label>

            <textarea
                name="notes"
                rows="4"
                class="w-full mt-2 border rounded-lg p-3">{{ old('notes') }}</textarea>

        </div>

        <div class="mt-8 flex justify-end">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow">

                💾 Guardar Cilindro

            </button>

        </div>

    </form>

</div>

@endsection