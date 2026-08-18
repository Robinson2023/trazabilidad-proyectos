@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- CABECERA --}}

    <div class="mb-6">

        <h1 class="text-3xl font-bold text-gray-800">
            📅 Nueva actividad
        </h1>

        <p class="text-gray-500 mt-1">
            Programa una actividad para un trabajador y proyecto.
        </p>

    </div>


    {{-- FORMULARIO --}}

    <div class="bg-white rounded-2xl
                border border-gray-200
                shadow-sm p-6">

        <form
            method="POST"
            action="{{ route('daily-schedules.store') }}">

            @csrf


            {{-- FECHA --}}

            <div class="mb-5">

                <label class="block
                              text-sm font-semibold
                              text-gray-700 mb-2">

                    📅 Fecha

                </label>

                <input
                    type="date"
                    name="date"
                    value="{{ request('date', now()->toDateString()) }}"
                    required
                    class="w-full border border-gray-300
                           rounded-lg p-3
                           focus:ring-2
                           focus:ring-blue-500">

            </div>


            {{-- TRABAJADOR --}}

            <div class="mb-5">

                <label class="block
                              text-sm font-semibold
                              text-gray-700 mb-2">

                    👷 Trabajador

                </label>

                <select
                    name="worker_id"
                    required
                    class="w-full border border-gray-300
                           rounded-lg p-3
                           bg-white
                           focus:ring-2
                           focus:ring-blue-500">

                    <option value="">
                        Seleccione un trabajador
                    </option>

                    @foreach($workers as $worker)

                        <option value="{{ $worker->id }}">

                            {{ $worker->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- PROYECTO --}}

            <div class="mb-5">

                <label class="block
                              text-sm font-semibold
                              text-gray-700 mb-2">

                    🏗 Proyecto

                </label>

                <select
                    name="project_id"
                    class="w-full border border-gray-300
                           rounded-lg p-3
                           bg-white
                           focus:ring-2
                           focus:ring-blue-500">

                    <option value="">
                        Sin proyecto
                    </option>

                    @foreach($projects as $project)

                        <option value="{{ $project->id }}">

                            {{ $project->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- ACTIVIDAD --}}

            <div class="mb-5">

                <label class="block
                              text-sm font-semibold
                              text-gray-700 mb-2">

                    📝 Actividad

                </label>

                <input
                    type="text"
                    name="activity"
                    value="{{ old('activity') }}"
                    placeholder="Ej: Soldadura de bastidor"
                    required
                    class="w-full border border-gray-300
                           rounded-lg p-3
                           focus:ring-2
                           focus:ring-blue-500">

            </div>


            {{-- HORARIOS --}}

            <div class="grid grid-cols-1 md:grid-cols-2
                        gap-5 mb-5">


                {{-- INICIO --}}

                <div>

                    <label class="block
                                  text-sm font-semibold
                                  text-gray-700 mb-2">

                        🕐 Hora de inicio

                    </label>

                    <input
                        type="time"
                        name="start_time"
                        value="{{ old('start_time') }}"
                        class="w-full border border-gray-300
                               rounded-lg p-3
                               focus:ring-2
                               focus:ring-blue-500">

                </div>


                {{-- FIN --}}

                <div>

                    <label class="block
                                  text-sm font-semibold
                                  text-gray-700 mb-2">

                        🕐 Hora de finalización

                    </label>

                    <input
                        type="time"
                        name="end_time"
                        value="{{ old('end_time') }}"
                        class="w-full border border-gray-300
                               rounded-lg p-3
                               focus:ring-2
                               focus:ring-blue-500">

                </div>

            </div>


            {{-- OBSERVACIONES --}}

            <div class="mb-6">

                <label class="block
                              text-sm font-semibold
                              text-gray-700 mb-2">

                    🗒 Observaciones

                </label>

                <textarea
                    name="notes"
                    rows="4"
                    placeholder="Observaciones de la actividad..."
                    class="w-full border border-gray-300
                           rounded-lg p-3
                           focus:ring-2
                           focus:ring-blue-500">{{ old('notes') }}</textarea>

            </div>


            {{-- BOTONES --}}

            <div class="flex flex-wrap gap-3">

                <button
                    type="submit"
                    class="bg-blue-600
                           hover:bg-blue-700
                           text-white
                           px-6 py-3
                           rounded-xl
                           font-semibold
                           shadow">

                    💾 Guardar actividad

                </button>


                <a
                    href="{{ route('daily-schedules.index') }}"
                    class="bg-gray-500
                           hover:bg-gray-600
                           text-white
                           px-6 py-3
                           rounded-xl
                           font-semibold">

                    ← Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

@endsection