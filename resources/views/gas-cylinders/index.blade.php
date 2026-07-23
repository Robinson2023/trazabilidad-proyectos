@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Encabezado --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">

                🟢 Control de Cilindros

            </h1>

            <p class="text-gray-500 mt-1">

                Administración de gases industriales.

            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('gas-cylinders.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

                ➕ Nuevo Cilindro

            </a>

            <a href="{{ route('gas-equipments.index') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">

                ⚙ Equipos

            </a>

            <a href="{{ route('gas-settings.index') }}"
                class="bg-gray-700 hover:bg-gray-800 text-white px-5 py-3 rounded-xl shadow">

                ⚙ Configuración

            </a>

        </div>

    </div>


    {{-- Mensaje --}}
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 rounded-xl p-4 mb-6">

            {{ session('success') }}

        </div>

    @endif


    {{-- Tabla --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">Número</th>

                    <th class="p-4 text-left">Gas</th>

                    <th class="p-4 text-left">Equipo</th>

                    <th class="p-4 text-left">Responsable</th>

                    <th class="p-4 text-center">Inicial</th>

                    <th class="p-4 text-center">Actual</th>

                    <th class="p-4 text-center">Estado</th>

                    <th class="p-4 text-center">Acciones</th>

                </tr>

            </thead>

            <tbody>

                @forelse($cylinders as $cylinder)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4 font-semibold">

                            {{ $cylinder->number }}

                        </td>

                        <td class="p-4">

                            {{ $cylinder->gas_type }}

                        </td>

                        <td class="p-4">

                            {{ $cylinder->equipment->name }}

                        </td>

                        <td class="p-4">

                            {{ $cylinder->worker->name }}

                        </td>

                        <td class="p-4 text-center">

                            {{ $cylinder->initial_lbs }}

                        </td>

                        <td class="p-4 text-center font-bold">

                            {{ $cylinder->current_lbs }}

                        </td>

                        <td class="p-4 text-center">

@if($cylinder->status['color'] == 'green')

    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

        🟢 {{ $cylinder->status['text'] }}

    </span>

@elseif($cylinder->status['color'] == 'yellow')

    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">

        🟡 {{ $cylinder->status['text'] }}

    </span>

@else

    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

        🔴 {{ $cylinder->status['text'] }}

    </span>

@endif

                        </td>

                        <td class="p-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('gas-cylinders.edit',$cylinder) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">

                                    ✏️

                                </a>

                                <form
    action="{{ route('gas-cylinders.destroy', $cylinder) }}"
    method="POST"
    class="inline"
    onsubmit="return confirm('¿Está seguro de eliminar este cilindro?');">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">

        🗑

    </button>

</form>
                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="text-center text-gray-500 py-10">

                            No existen cilindros registrados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection