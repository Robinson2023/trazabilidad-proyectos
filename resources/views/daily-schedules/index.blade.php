@extends('layouts.app')

@section('content')

{{-- ===================================================== --}}
{{-- CABECERA --}}
{{-- ===================================================== --}}

<div class="mb-6">

    <div class="flex flex-col md:flex-row
                md:items-center md:justify-between
                gap-4">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                📅 Cronograma
            </h1>

            <p class="text-gray-500 mt-1">
                Planificación diaria de actividades y personal.
            </p>

        </div>


        {{-- NUEVA ACTIVIDAD --}}

        <a
            href="{{ route('daily-schedules.create', [
                'date' => $date
            ]) }}"
            class="inline-flex
                   items-center
                   justify-center
                   w-fit
                   bg-blue-600
                   hover:bg-blue-700
                   text-white
                   px-2 py-2
                   rounded-lg
                   shadow-sm
                   font-semibold
                   text-sm
                   whitespace-nowrap">

            ➕ Nueva actividad

        </a>

    </div>

</div>


{{-- ===================================================== --}}
{{-- NAVEGACIÓN DEL DÍA --}}
{{-- ===================================================== --}}

@php

    $currentDate = \Carbon\Carbon::parse($date);

    $previousDate = $currentDate
        ->copy()
        ->subDay()
        ->format('Y-m-d');

    $nextDate = $currentDate
        ->copy()
        ->addDay()
        ->format('Y-m-d');

    $today = now()->format('Y-m-d');

@endphp


<div class="bg-white rounded-xl
            border border-gray-200
            shadow-sm
            p-4 mb-6">


    {{-- NAVEGACIÓN HORIZONTAL --}}

    <div class="flex items-center
                justify-between
                gap-4">


        {{-- DÍA ANTERIOR --}}

        <a
            href="{{ route('daily-schedules.index', [
                'date' => $previousDate
            ]) }}"
            class="inline-flex
                   items-center
                   justify-center
                   bg-gray-100
                   hover:bg-gray-200
                   text-gray-700
                   px-4 py-2
                   rounded-lg
                   font-semibold
                   text-sm
                   whitespace-nowrap
                   transition">

            ← Día anterior

        </a>


        {{-- FECHA CENTRAL --}}

        <div class="text-center flex-1 min-w-0">

            <p class="text-xs uppercase
                      tracking-wide
                      text-gray-400
                      font-semibold">

                Cronograma

            </p>

            <h2 class="text-xl font-bold
                       text-gray-800 mt-1">

                {{ $currentDate->translatedFormat(
                    'l d \d\e F \d\e Y'
                ) }}

            </h2>


            @if($date === $today)

                <span
                    class="inline-flex
                           items-center
                           mt-2
                           bg-blue-100
                           text-blue-700
                           px-3 py-1
                           rounded-full
                           text-xs
                           font-semibold">

                    📅 Hoy

                </span>

            @else

                <a
                    href="{{ route('daily-schedules.index', [
                        'date' => $today
                    ]) }}"
                    class="inline-flex
                           items-center
                           mt-2
                           bg-blue-600
                           hover:bg-blue-700
                           text-white
                           px-3 py-1
                           rounded-full
                           text-xs
                           font-semibold">

                    📅 Volver a hoy

                </a>

            @endif

        </div>


        {{-- DÍA SIGUIENTE --}}

        <a
            href="{{ route('daily-schedules.index', [
                'date' => $nextDate
            ]) }}"
            class="inline-flex
                   items-center
                   justify-center
                   bg-gray-100
                   hover:bg-gray-200
                   text-gray-700
                   px-4 py-2
                   rounded-lg
                   font-semibold
                   text-sm
                   whitespace-nowrap
                   transition">

            Día siguiente →

        </a>

    </div>

</div>


{{-- ===================================================== --}}
{{-- ACTIVIDADES --}}
{{-- ===================================================== --}}

<div class="bg-white rounded-xl
            border border-gray-200
            shadow-sm
            overflow-hidden">


    {{-- ENCABEZADO --}}

    <div class="px-5 py-4
                border-b border-gray-200
                bg-gray-50">

        <h2 class="text-lg font-bold text-gray-800">

            📋 Actividades del día

        </h2>

        <p class="text-sm text-gray-500">

            {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}

        </p>

    </div>


    {{-- LISTA DE ACTIVIDADES --}}

    <div class="divide-y">

        @forelse($schedules as $schedule)


            {{-- ================================================= --}}
            {{-- ACTIVIDAD --}}
            {{-- ================================================= --}}

            <div class="px-5 py-4
                        hover:bg-gray-50
                        transition">


                <div class="grid grid-cols-1
                            lg:grid-cols-[110px_minmax(0,1fr)_130px_96px]
                            gap-4
                            items-center">


                    {{-- ========================================= --}}
                    {{-- HORA --}}
                    {{-- ========================================= --}}

                    <div class="shrink-0">

                        <p class="text-xl font-bold
                                  text-blue-700">

                            {{ $schedule->start_time
                                ? \Carbon\Carbon::parse(
                                    $schedule->start_time
                                )->format('H:i')
                                : '--:--'
                            }}

                        </p>


                        @if($schedule->end_time)

                            <p class="text-xs text-gray-400">

                                hasta
                                {{ \Carbon\Carbon::parse(
                                    $schedule->end_time
                                )->format('H:i') }}

                            </p>

                        @endif

                    </div>


                    {{-- ========================================= --}}
                    {{-- INFORMACIÓN --}}
                    {{-- ========================================= --}}

                    <div class="min-w-0">

                        <h3 class="font-bold text-lg
                                   text-gray-800
                                   leading-tight
                                   break-words">

                            {{ $schedule->activity }}

                        </h3>


                        <div class="flex flex-wrap
                                    gap-x-5 gap-y-1
                                    mt-2">

                            <p class="text-sm text-gray-500">

                                👷
                                {{ $schedule->worker?->name
                                    ?? 'Sin trabajador'
                                }}

                            </p>


                            <p class="text-sm text-gray-500">

                                🏗
                                {{ $schedule->project?->name
                                    ?? 'Sin proyecto'
                                }}

                            </p>

                        </div>

                    </div>


                    {{-- ========================================= --}}
                    {{-- ESTADO --}}
                    {{-- ========================================= --}}

                    <div class="flex
                                justify-start
                                lg:justify-center">

                        @if($schedule->status === 'pending')

                            <span
                                class="inline-flex
                                       items-center
                                       justify-center
                                       w-[120px]
                                       bg-gray-100
                                       text-gray-700
                                       px-3 py-2
                                       rounded-full
                                       text-xs
                                       font-semibold
                                       whitespace-nowrap">

                                ⚪ Pendiente

                            </span>


                        @elseif($schedule->status === 'in_progress')

                            <span
                                class="inline-flex
                                       items-center
                                       justify-center
                                       w-[120px]
                                       bg-yellow-100
                                       text-yellow-700
                                       px-3 py-2
                                       rounded-full
                                       text-xs
                                       font-semibold
                                       whitespace-nowrap">

                                🟡 En proceso

                            </span>


                        @else

                            <span
                                class="inline-flex
                                       items-center
                                       justify-center
                                       w-[120px]
                                       bg-green-100
                                       text-green-700
                                       px-3 py-2
                                       rounded-full
                                       text-xs
                                       font-semibold
                                       whitespace-nowrap">

                                🟢 Terminada

                            </span>

                        @endif

                    </div>


                {{-- ========================================= --}}
                {{-- ACCIONES --}}
                {{-- ========================================= --}}

                    <div class="flex items-center
                                justify-start
                                lg:justify-end
                                gap-2
                                shrink-0">


                        {{-- ========================================= --}}
                        {{-- CAMBIAR ESTADO --}}
                        {{-- ========================================= --}}

                        @if(
                            auth()->check() &&
                            in_array(
                                auth()->user()->role,
                                ['admin', 'management', 'supervisor']
                            )
                        )


                            {{-- PENDIENTE → EN PROCESO --}}

                            @if($schedule->status === 'pending')

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'daily-schedules.start',
                                        $schedule
                                    ) }}">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="w-10 h-10
                                            shrink-0
                                            inline-flex
                                            items-center
                                            justify-center
                                            bg-blue-600
                                            hover:bg-blue-700
                                            text-white
                                            rounded-lg
                                            transition"
                                        title="Iniciar actividad">

                                        ▶️

                                    </button>

                                </form>


                            {{-- EN PROCESO → TERMINADA --}}

                            @elseif($schedule->status === 'in_progress')

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'daily-schedules.complete',
                                        $schedule
                                    ) }}"
                                    onsubmit="return confirm(
                                        '¿Marcar esta actividad como terminada?'
                                    );">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="w-10 h-10
                                            shrink-0
                                            inline-flex
                                            items-center
                                            justify-center
                                            bg-green-600
                                            hover:bg-green-700
                                            text-white
                                            rounded-lg
                                            transition"
                                        title="Marcar como terminada">

                                        ✅

                                    </button>

                                </form>

                            @endif

                        @endif


                        {{-- ========================================= --}}
                        {{-- EDITAR --}}
                        {{-- ========================================= --}}

                        <a
                            href="{{ route(
                                'daily-schedules.edit',
                                $schedule
                            ) }}"
                            class="w-10 h-10
                                shrink-0
                                inline-flex
                                items-center
                                justify-center
                                bg-yellow-500
                                hover:bg-yellow-600
                                text-white
                                rounded-lg
                                transition"
                            title="Editar actividad">

                            ✏️

                        </a>


                        {{-- ========================================= --}}
                        {{-- ELIMINAR --}}
                        {{-- ========================================= --}}

                        <form
                            method="POST"
                            action="{{ route(
                                'daily-schedules.destroy',
                                $schedule
                            ) }}"
                            onsubmit="return confirm(
                                '¿Eliminar esta actividad?'
                            );">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="w-10 h-10
                                    shrink-0
                                    inline-flex
                                    items-center
                                    justify-center
                                    bg-red-600
                                    hover:bg-red-700
                                    text-white
                                    rounded-lg
                                    transition"
                                title="Eliminar actividad">

                                🗑️

                            </button>

                        </form>

                    </div>

                </div>

            </div>


        @empty


            {{-- ================================================= --}}
            {{-- SIN ACTIVIDADES --}}
            {{-- ================================================= --}}

            <div class="p-10 text-center">

                <div class="text-5xl mb-3">

                    📅

                </div>


                <p class="text-gray-500">

                    No hay actividades programadas
                    para este día.

                </p>


                <a
                    href="{{ route(
                        'daily-schedules.create',
                        ['date' => $date]
                    ) }}"
                    class="inline-flex
                           items-center
                           mt-4
                           bg-blue-600
                           hover:bg-blue-700
                           text-white
                           px-5 py-2
                           rounded-lg
                           font-semibold">

                    ➕ Programar actividad

                </a>

            </div>


        @endforelse

    </div>

</div>

@endsection