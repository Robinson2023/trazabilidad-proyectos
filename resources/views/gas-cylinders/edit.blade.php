@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- CABECERA --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold">

                ✏️ Editar Cilindro

            </h1>

            <p class="text-gray-500 mt-1">

                Actualización de información del cilindro.

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
        action="{{ route('gas-cylinders.update', $gasCylinder) }}"
        method="POST"
        class="bg-white rounded-2xl shadow-lg p-8">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="font-semibold">

                    Número del Cilindro

                </label>

                <input
                    type="text"
                    name="number"
                    value="{{ old('number', $gasCylinder->number) }}"
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

                    <option value="Argón" @selected(old('gas_type',$gasCylinder->gas_type)=='Argón')>Argón</option>

                    <option value="Agamix" @selected(old('gas_type',$gasCylinder->gas_type)=='Agamix')>Agamix</option>

                    <option value="Oxígeno" @selected(old('gas_type',$gasCylinder->gas_type)=='Oxígeno')>Oxígeno</option>

                    <option value="Acetileno" @selected(old('gas_type',$gasCylinder->gas_type)=='Acetileno')>Acetileno</option>

                </select>

            </div>

            <div>

                <label class="font-semibold">

                    Equipo

                </label>

                <select
                    name="equipment_id"
                    class="w-full mt-2 border rounded-lg p-3">

                    <option value="">Seleccione...</option>

                    @foreach($equipments as $equipment)

                        <option
                            value="{{ $equipment->id }}"
                            @selected(old('equipment_id',$gasCylinder->equipment_id)==$equipment->id)>

                            {{ $equipment->code }} - {{ $equipment->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="font-semibold">

                    Responsable

                </label>

                <select
                    name="worker_id"
                    class="w-full mt-2 border rounded-lg p-3">

                    <option value="">Seleccione...</option>

                    @foreach($workers as $worker)

                        <option
                            value="{{ $worker->id }}"
                            @selected(old('worker_id',$gasCylinder->worker_id)==$worker->id)>

                            {{ $worker->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="font-semibold">

                    Fecha de Inicio

                </label>

                <input
                    type="date"
                    name="start_date"
                    value="{{ old('start_date', $gasCylinder->start_date) }}"
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
                    value="{{ old('initial_lbs', $gasCylinder->initial_lbs) }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">

                    Libras Actuales

                </label>

                <input
                    type="number"
                    step="0.01"
                    name="current_lbs"
                    value="{{ old('current_lbs', $gasCylinder->current_lbs) }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

        </div>

        <div>
            <label class="font-semibold">
                Costo de la recarga
            </label>

            <input
                type="number"
                step="0.01"
                name="cylinder_cost"
                value="{{ old('cylinder_cost', $gasCylinder->cylinder_cost) }}"
                class="w-full mt-2 border rounded-lg p-3">
        </div>

        <div>
            <label class="font-semibold">
                Costo por libra
            </label>

            <input
                type="text"
                value="${{ number_format($gasCylinder->cost_per_lb,2) }}"
                class="w-full mt-2 border rounded-lg p-3 bg-gray-100"
                readonly>
    </div>
        <div class="mt-6">

            <label class="font-semibold">

                Observaciones

            </label>

            <textarea
                name="notes"
                rows="4"
                class="w-full mt-2 border rounded-lg p-3">{{ old('notes', $gasCylinder->notes) }}</textarea>

        </div>

        <div class="mt-8 flex justify-end">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl shadow">

                💾 Actualizar Cilindro

            </button>

        </div>

    </form>

</div>

@endsection