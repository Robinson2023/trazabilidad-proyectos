@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- CABECERA --}}

    <div class="mb-6">

        <h1 class="text-3xl font-bold text-gray-800">
            ✏️ Editar actividad
        </h1>

        <p class="text-gray-500 mt-1">
            Modifica la planificación de esta actividad.
        </p>

    </div>


    {{-- FORMULARIO --}}

    <div class="bg-white rounded-2xl
                border border-gray-200
                shadow-sm p-6">

        <form
            method="POST"
            action="{{ route('daily-schedules.update', $dailySchedule) }}">

            @csrf
            @method('PUT')


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
                    value="{{ old(
                        'date',
                        $dailySchedule->date->format('Y-m-d')
                    ) }}"
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
                           bg-white">

                    @foreach($workers as $worker)

                        <option
                            value="{{ $worker->id }}"
                            @selected(
                                old(
                                    'worker_id',
                                    $dailySchedule->worker_id
                                ) == $worker->id
                            )>

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
                           bg-white">

                    <option value="">
                        Sin proyecto
                    </option>

                    @foreach($projects as $project)

                        <option
                            value="{{ $project->id }}"
                            @selected(
                                old(
                                    'project_id',
                                    $dailySchedule->project_id
                                ) == $project->id
                            )>

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
                    value="{{ old(
                        'activity',
                        $dailySchedule->activity
                    ) }}"
                    required
                    class="w-full border border-gray-300
                           rounded-lg p-3">

            </div>


            {{-- HORARIOS --}}

            <div class="grid grid-cols-1 md:grid-cols-2
                        gap-5 mb-5">

                <div>

                    <label class="block
                                  text-sm font-semibold
                                  text-gray-700 mb-2">

                        🕐 Hora de inicio

                    </label>

                    <input
                        type="time"
                        name="start_time"
                        value="{{ old(
                            'start_time',
                            $dailySchedule->start_time
                        ) }}"
                        class="w-full border border-gray-300
                               rounded-lg p-3">

                </div>


                <div>

                    <label class="block
                                  text-sm font-semibold
                                  text-gray-700 mb-2">

                        🕐 Hora de finalización

                    </label>

                    <input
                        type="time"
                        name="end_time"
                        value="{{ old(
                            'end_time',
                            $dailySchedule->end_time
                        ) }}"
                        class="w-full border border-gray-300
                               rounded-lg p-3">

                </div>

            </div>


            {{-- ESTADO --}}

            <div class="mb-5">

                <label class="block
                              text-sm font-semibold
                              text-gray-700 mb-2">

                    📌 Estado

                </label>

                <select
                    name="status"
                    class="w-full border border-gray-300
                           rounded-lg p-3">

                    <option value="pending"
                        @selected(
                            old(
                                'status',
                                $dailySchedule->status
                            ) === 'pending'
                        )>

                        ⚪ Pendiente

                    </option>

                    <option value="in_progress"
                        @selected(
                            old(
                                'status',
                                $dailySchedule->status
                            ) === 'in_progress'
                        )>

                        🟡 En proceso

                    </option>

                    <option value="completed"
                        @selected(
                            old(
                                'status',
                                $dailySchedule->status
                            ) === 'completed'
                        )>

                        🟢 Terminada

                    </option>

                </select>

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
                    class="w-full border border-gray-300
                           rounded-lg p-3">{{ old(
                                'notes',
                                $dailySchedule->notes
                            ) }}</textarea>

            </div>


            {{-- BOTONES --}}

            <div class="flex flex-wrap gap-3">

                <button
                    type="submit"
                    class="bg-blue-600
                           hover:bg-blue-700
                           text-white px-6 py-3
                           rounded-xl
                           font-semibold">

                    💾 Guardar cambios

                </button>


                <a
                    href="{{ route('daily-schedules.index', [
                        'date' => $dailySchedule->date->format('Y-m-d')
                    ]) }}"
                    class="bg-gray-500
                           hover:bg-gray-600
                           text-white px-6 py-3
                           rounded-xl
                           font-semibold">

                    ← Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

@endsection