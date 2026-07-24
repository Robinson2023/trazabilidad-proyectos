@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- CABECERA --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold">

                ➕ Nuevo Equipo

            </h1>
<br>
            <p class="text-gray-500 mt-1">

                Registro de equipos consumidores de gases industriales.

            </p>

        </div>
<br>
        <a href="{{ route('gas-equipments.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-xl shadow">

            ← Volver

        </a>

    </div>

    {{-- ERRORES --}}
    @if ($errors->any())

        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-xl p-4">

            <ul class="list-disc ml-6">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- FORMULARIO --}}
    <form action="{{ route('gas-equipments.store') }}"
          method="POST"
          class="bg-white rounded-2xl shadow-lg p-8 space-y-6">

        @csrf

        <div>

            <label class="font-semibold">

                Código

            </label>

            <input
                type="text"
                name="code"
                value="{{ old('code') }}"
                class="w-full mt-2 border rounded-lg p-3"
                placeholder="EQ-001">

        </div>

        <div>

            <label class="font-semibold">

                Nombre del Equipo

            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full mt-2 border rounded-lg p-3"
                placeholder="Soldadora Miller">

        </div>

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="font-semibold">

                    Marca

                </label>

                <input
                    type="text"
                    name="brand"
                    value="{{ old('brand') }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">

                    Modelo

                </label>

                <input
                    type="text"
                    name="model"
                    value="{{ old('model') }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">
                    Responsable
                </label>

                <select
                    name="worker_id"
                    class="w-full mt-2 border rounded-lg p-3">

                    <option value="">
                        Sin asignar
                    </option>

                    @foreach($workers as $worker)

                        <option
                            value="{{ $worker->id }}"
                            {{ old('worker_id') == $worker->id ? 'selected' : '' }}>

                            {{ $worker->name }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        <div>

            <label class="inline-flex items-center">

                <input
                    type="checkbox"
                    name="active"
                    checked
                    class="mr-2">

                Equipo Activo

            </label>

        </div>

        <div class="pt-4">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow">

                💾 Guardar Equipo

            </button>

        </div>

    </form>

</div>

@endsection