@extends('layouts.app')

@section('content')

{{-- ===================================================== --}}
{{-- CABECERA DE LA PÁGINA --}}
{{-- ===================================================== --}}

<div class="flex justify-between items-center mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">

            🧯 Cilindro {{ $gasCylinder->number }}

        </h1>

        <p class="text-gray-500 mt-1">

            Información y estado actual del cilindro.

        </p>

    </div>


    <a
        href="{{ route('gas-cylinders.index') }}"
        class="bg-gray-600 hover:bg-gray-700
               text-black px-5 py-2
               rounded-xl shadow">

        ← Volver

    </a>

</div>


{{-- ===================================================== --}}
{{-- IDENTIFICACIÓN DEL CILINDRO --}}
{{-- ===================================================== --}}

<div class="bg-slate-800
            rounded-2xl
            shadow-md
            border border-slate-700
            p-6">

    <div class="flex justify-between
                items-center
                gap-4">

        {{-- INFORMACIÓN --}}

        <div>

            <p class="text-sm text-slate-300">
                🧯 Cilindro
            </p>

            <h2 class="text-2xl font-bold text-black mt-1">

                {{ $gasCylinder->number }}

            </h2>

            <p class="text-sm text-slate-300 mt-1">

                {{ $gasCylinder->gas_type }}

            </p>

        </div>


        {{-- ESTADO --}}

        <div>

            @if($gasCylinder->status['color'] == 'green')

                <span class="inline-flex items-center
                             bg-green-100
                             text-green-700
                             px-4 py-2
                             rounded-full
                             font-semibold
                             whitespace-nowrap">

                    🟢 {{ $gasCylinder->status['text'] }}

                </span>

            @elseif($gasCylinder->status['color'] == 'yellow')

                <span class="inline-flex items-center
                             bg-yellow-100
                             text-yellow-800
                             px-4 py-2
                             rounded-full
                             font-semibold
                             whitespace-nowrap">

                    🟡 {{ $gasCylinder->status['text'] }}

                </span>

            @else

                <span class="inline-flex items-center
                             bg-red-100
                             text-red-700
                             px-4 py-2
                             rounded-full
                             font-semibold
                             whitespace-nowrap">

                    🔴 {{ $gasCylinder->status['text'] }}

                </span>

            @endif

        </div>

    </div>

</div>

{{-- ===================================================== --}}
{{-- UBICACIÓN Y RESPONSABLE --}}
{{-- ===================================================== --}}

<div class="grid grid-cols-1 md:grid-cols-2
            gap-4 mt-5">


    {{-- UBICACIÓN --}}

    <div class="bg-white
                rounded-2xl
                shadow-md
                border border-gray-200
                p-5">

        <p class="text-xs uppercase
                  tracking-wide
                  text-gray-400
                  font-semibold">

            📍 Ubicación / uso

        </p>

        <p class="text-lg
                  font-bold
                  text-gray-800
                  mt-2">

            @if($gasCylinder->equipment)

                🔧 {{ $gasCylinder->equipment->name }}

            @else

                🏭 Almacén

            @endif

        </p>

    </div>


    {{-- RESPONSABLE --}}

    <div class="bg-white
                rounded-2xl
                shadow-md
                border border-gray-200
                p-5">

        <p class="text-xs uppercase
                  tracking-wide
                  text-gray-400
                  font-semibold">

            👤 Responsable

        </p>

        <p class="text-lg
                  font-bold
                  text-gray-800
                  mt-2">

            {{ $gasCylinder->worker?->name ?? 'Sin asignar' }}

        </p>

    </div>

</div>


{{-- ===================================================== --}}
{{-- INFORMACIÓN DEL CILINDRO --}}
{{-- ===================================================== --}}

<div class="bg-white
            rounded-2xl
            shadow-md
            border border-gray-200
            p-5
            mt-5">

    <div class="mb-5">

        <h2 class="text-xl font-bold text-gray-800">

            📊 Información del cilindro

        </h2>

        <p class="text-sm text-gray-500 mt-1">

            Estado de carga y costos actuales.

        </p>

    </div>


    {{-- ================================================= --}}
    {{-- FICHAS --}}
    {{-- ================================================= --}}

    <div class="grid grid-cols-2
                md:grid-cols-4
                gap-4">


        {{-- INICIAL --}}

        <div class="bg-gray-50
                    border border-gray-200
                    rounded-xl
                    p-4">

            <p class="text-xs uppercase
                      tracking-wide
                      text-gray-400
                      font-semibold">

                Libras iniciales

            </p>

            <p class="text-2xl
                      font-bold
                      text-gray-800
                      mt-2">

                {{ number_format(
                    $gasCylinder->initial_lbs,
                    2
                ) }}

            </p>

            <p class="text-xs text-gray-400">
                lb
            </p>

        </div>


        {{-- ACTUAL --}}

        <div class="bg-blue-50
                    border border-blue-100
                    rounded-xl
                    p-4">

            <p class="text-xs uppercase
                      tracking-wide
                      text-gray-400
                      font-semibold">

                Libras actuales

            </p>

            <p class="text-2xl
                      font-bold
                      text-blue-600
                      mt-2">

                {{ number_format(
                    $gasCylinder->current_lbs,
                    2
                ) }}

            </p>

            <p class="text-xs text-gray-400">
                lb
            </p>

        </div>


        {{-- CONSUMIDO --}}

        <div class="bg-orange-50
                    border border-orange-100
                    rounded-xl
                    p-4">

            <p class="text-xs uppercase
                      tracking-wide
                      text-gray-400
                      font-semibold">

                Consumido

            </p>

            <p class="text-2xl
                      font-bold
                      text-orange-500
                      mt-2">

                {{ number_format(
                    $gasCylinder->initial_lbs -
                    $gasCylinder->current_lbs,
                    2
                ) }}

            </p>

            <p class="text-xs text-gray-400">
                lb
            </p>

        </div>


        {{-- COSTO / LIBRA --}}

        <div class="bg-green-50
                    border border-green-100
                    rounded-xl
                    p-4">

            <p class="text-xs uppercase
                      tracking-wide
                      text-gray-400
                      font-semibold">

                Costo / libra

            </p>

            <p class="text-2xl
                      font-bold
                      text-green-600
                      mt-2">

                ${{ number_format(
                    $gasCylinder->cost_per_lb ?? 0,
                    2
                ) }}

            </p>

        </div>

    </div>


    {{-- ================================================= --}}
    {{-- COSTO DEL CILINDRO --}}
    {{-- ================================================= --}}

    <div class="mt-5
                pt-4
                border-t border-gray-200
                flex justify-between
                items-center">

        <span class="text-sm text-gray-500">

            Costo del cilindro

        </span>

        <strong class="text-xl text-gray-800">

            ${{ number_format(
                $gasCylinder->cylinder_cost ?? 0,
                0
            ) }}

        </strong>

    </div>

</div>


{{-- ===================================================== --}}
{{-- ACCIONES --}}
{{-- ===================================================== --}}

<div class="bg-gray
            rounded-2xl
            shadow-md
            border border-gray-200
            p-5
            mt-5">

    <h2 class="text-xl
               font-bold
               text-gray-800
               mb-1">

        ⚙️ Acciones

    </h2>

    <p class="text-sm text-gray-500 mb-4">

        Gestione la información y consumo del cilindro.

    </p>


    <div class="flex flex-wrap gap-3">


        {{-- EDITAR --}}

        <a
            href="{{ route(
                'gas-cylinders.edit',
                $gasCylinder
            ) }}"
            class="bg-yellow-500
                   hover:bg-yellow-600
                   text-white
                   px-5 py-3
                   rounded-xl
                   font-semibold
                   shadow-sm">

            ✏️ Editar

        </a>


        {{-- CONSUMO --}}

        <a
            href="{{ route(
                'gas-consumptions.create',
                $gasCylinder
            ) }}"
            class="bg-green-600
                   hover:bg-green-700
                   text-white
                   px-5 py-3
                   rounded-xl
                   font-semibold
                   shadow-sm">

            📋 Registrar consumo

        </a>


        {{-- HISTORIAL --}}

        <a
            href="{{ route(
                'gas-consumptions.history',
                $gasCylinder
            ) }}"
            class="bg-blue-600
                   hover:bg-blue-700
                   text-white
                   px-5 py-3
                   rounded-xl
                   font-semibold
                   shadow-sm">

            📜 Historial

        </a>

    </div>

</div>


{{-- ===================================================== --}}
{{-- OBSERVACIONES --}}
{{-- ===================================================== --}}

@if($gasCylinder->notes)

    <div class="bg-white
                rounded-2xl
                shadow-md
                border border-gray-200
                p-5
                mt-5">

        <h2 class="text-lg
                   font-bold
                   text-gray-800
                   mb-2">

            📝 Observaciones

        </h2>

        <p class="text-gray-600">

            {{ $gasCylinder->notes }}

        </p>

    </div>

@endif


@endsection