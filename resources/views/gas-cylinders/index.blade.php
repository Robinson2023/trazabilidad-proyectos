@extends('layouts.app')

@section('content')

{{-- ===================================================== --}}
{{-- CABECERA --}}
{{-- ===================================================== --}}

<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            🧯 Control de Cilindros
        </h1>

        <p class="text-gray-500 mt-1">
            Estado y ubicación de los cilindros de gases industriales.
        </p>

    </div>

    <div class="flex gap-3">

        <a
            href="{{ route('gas-cylinders.create') }}"
            class="bg-blue-600 hover:bg-blue-700
                   text-white px-5 py-3 rounded-xl shadow">

            ➕ Nuevo Cilindro

        </a>

        <a
            href="{{ route('gas-equipments.index') }}"
            class="bg-green-600 hover:bg-green-700
                   text-white px-5 py-3 rounded-xl shadow">

            ⚙ Equipos

        </a>

        <a
            href="{{ route('gas-settings.index') }}"
            class="bg-gray-700 hover:bg-gray-800
                   text-black px-5 py-3 rounded-xl shadow">

            ⚙ Configuración

        </a>

    </div>

</div>


{{-- ===================================================== --}}
{{-- MENSAJE --}}
{{-- ===================================================== --}}

@if(session('success'))

    <div class="bg-green-100 border border-green-300
                text-green-700 rounded-xl p-4 mb-6">

        {{ session('success') }}

    </div>

@endif

{{-- ===================================================== --}}
{{-- CLASIFICACIÓN --}}
{{-- ===================================================== --}}

@php

    $available = $cylinders->where(
        'lifecycle_status',
        'available'
    );

    $inUse = $cylinders->where(
        'lifecycle_status',
        'in_use'
    );

    $pendingReturn = $cylinders->where(
        'lifecycle_status',
        'pending_return'
    );

    $delivered = $cylinders->where(
        'lifecycle_status',
        'delivered'
    );

    $currentCylinders = $available->merge($inUse);

@endphp

<br>

{{-- ===================================================== --}}
{{-- RESUMEN --}}
{{-- ===================================================== --}}

<div class="flex flex-wrap gap-3 mb-8">


    {{-- ALMACÉN --}}

    <div class="bg-white rounded-xl shadow-md
            border border-green-100
            px-4 py-3 w-44">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-xs text-gray-500">
                En almacén
            </p>

            <p class="text-2xl font-bold text-green-600">
                {{ $available->count() }}
            </p>

        </div>

        <span class="text-2xl">
            🟢
        </span>

    </div>

</div>


    {{-- EN USO --}}

    <div class="bg-white rounded-xl shadow-md
            border border-blue-100
            px-4 py-3 w-44">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-xs text-gray-500">
                En uso
            </p>

            <p class="text-2xl font-bold text-blue-600">
                {{ $inUse->count() }}
            </p>

        </div>

        <span class="text-2xl">
            🔵
        </span>

    </div>

</div>


    {{-- PENDIENTES --}}

    <div class="bg-white rounded-xl shadow-md
            border border-yellow-100
            px-4 py-3 w-44">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-xs text-gray-500">
                Por entregar
            </p>

            <p class="text-2xl font-bold text-yellow-600">
                {{ $pendingReturn->count() }}
            </p>

        </div>

        <span class="text-2xl">
            🟠
        </span>

    </div>

</div>

    {{-- ENTREGADOS --}}

    <div class="bg-white rounded-xl shadow-md
            border border-gray-200
            px-4 py-3 w-44">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-xs text-gray-500">
                Entregados
            </p>

            <p class="text-2xl font-bold text-gray-600">
                {{ $delivered->count() }}
            </p>

        </div>

        <span class="text-2xl">
            ⚫
        </span>

    </div>

</div>

</div>

<br><br>

{{-- ===================================================== --}}
{{-- CILINDROS EN TALLER --}}
{{-- ===================================================== --}}

<div class="bg-white rounded-2xl shadow-lg
            overflow-hidden mb-10">

    <div class="px-5 py-4 border-b bg-gray-50">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    🏭 Cilindros en taller
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Cilindros disponibles y actualmente en uso.
                </p>

            </div>

            <span class="bg-blue-100 text-blue-700
                         px-3 py-1 rounded-full
                         text-sm font-semibold">

                {{ $currentCylinders->count() }}

            </span>

        </div>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-5 py-3 text-left text-sm">
                        Cilindro
                    </th>

                    <th class="px-5 py-3 text-left text-sm">
                        Gas
                    </th>

                    <th class="px-5 py-3 text-left text-sm">
                        Ubicación / uso
                    </th>

                    <th class="px-5 py-3 text-left text-sm">
                        Responsable
                    </th>

                    <th class="px-5 py-3 text-center text-sm">
                        Libras
                    </th>

                    <th class="px-5 py-3 text-center text-sm">
                        Estado
                    </th>

                    <th class="px-5 py-3 text-center text-sm">
                        Acción
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($currentCylinders as $cylinder)

                    <tr class="border-b hover:bg-gray-50">


                        {{-- CILINDRO --}}

                        <td class="px-5 py-4">

                            <span class="font-semibold text-gray-800">

                                {{ $cylinder->number }}

                            </span>

                        </td>


                        {{-- GAS --}}

                        <td class="px-5 py-4">

                            {{ $cylinder->gas_type }}

                        </td>


                        {{-- UBICACIÓN / USO --}}

                        <td class="px-5 py-4">

                            @if($cylinder->lifecycle_status === 'available')

                                <span class="text-green-700 font-medium">

                                    🏭 Almacén

                                </span>

                            @else

                                <span class="text-blue-700 font-medium">

                                    🔧 {{ $cylinder->equipment?->name ?? 'En uso' }}

                                </span>

                            @endif

                        </td>


                        {{-- RESPONSABLE --}}

                        <td class="px-5 py-4">

                            {{ $cylinder->worker?->name ?? '—' }}

                        </td>


                        {{-- LIBRAS --}}

                        <td class="px-5 py-4 text-center">

                            <span class="font-bold">

                                {{ number_format($cylinder->current_lbs, 0) }}

                            </span>

                            <span class="text-xs text-gray-400">
                                lb
                            </span>

                        </td>


                        {{-- ESTADO DEL GAS --}}

                        <td class="px-5 py-4 text-center">

                            @if($cylinder->status['color'] == 'green')

                                <span class="inline-flex
                                             bg-green-100
                                             text-green-700
                                             px-3 py-1
                                             rounded-full
                                             text-xs font-semibold">

                                    🟢 Disponible

                                </span>

                            @elseif($cylinder->status['color'] == 'yellow')

                                <span class="inline-flex
                                             bg-yellow-100
                                             text-yellow-800
                                             px-3 py-1
                                             rounded-full
                                             text-xs font-semibold">

                                    🟡 Solicitar

                                </span>

                            @else

                                <span class="inline-flex
                                             bg-red-100
                                             text-red-700
                                             px-3 py-1
                                             rounded-full
                                             text-xs font-semibold">

                                    🔴 Cambiar

                                </span>

                            @endif

                        </td>

                        {{-- ACCIÓN --}}

                            <td class="px-5 py-4 text-center">

                                <div class="flex justify-center items-center gap-2">

                                    {{-- VER --}}

                                    <a
                                        href="{{ route('gas-cylinders.show', $cylinder) }}"
                                        class="inline-flex items-center justify-center gap-1
                                            bg-blue-600 hover:bg-blue-700
                                            text-white
                                            px-4 py-2
                                            rounded-lg
                                            text-sm font-semibold
                                            whitespace-nowrap
                                            shadow-sm">

                                        👁 Ver

                                    </a>


                                    {{-- POR ENTREGAR --}}

                                    @if($cylinder->lifecycle_status === 'in_use')

                                        <form
                                            action="{{ route('gas-cylinders.pending-return', $cylinder) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('¿Marcar este cilindro como pendiente de entrega?');">

                                            @csrf

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center
                                                    bg-orange-500 hover:bg-orange-600
                                                    text-black
                                                    px-4 py-2
                                                    rounded-lg
                                                    text-sm font-semibold
                                                    whitespace-nowrap
                                                    shadow-sm">

                                                📦 Por entregar

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="text-center text-gray-500 py-10">

                            No hay cilindros disponibles o en uso.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<br><br>
{{-- ===================================================== --}}
{{-- PENDIENTES DE ENTREGA --}}
{{-- ===================================================== --}}

<div class="bg-white rounded-2xl shadow-lg
            overflow-hidden mb-10">

    <div class="px-5 py-4 border-b bg-yellow-50">

        <h2 class="text-xl font-bold text-gray-800">
            🟠 Cilindros pendientes de entrega
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Cilindros retirados del servicio pendientes de devolución.
        </p>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-5 py-3 text-left">
                        Cilindro
                    </th>

                    <th class="px-5 py-3 text-left">
                        Gas
                    </th>

                    <th class="px-5 py-3 text-left">
                        Equipo anterior
                    </th>

                    <th class="px-5 py-3 text-center">
                        Libras
                    </th>

                    <th class="px-5 py-3 text-center text-sm w-28">
                        Acción
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($pendingReturn as $cylinder)

                    <tr class="border-b hover:bg-yellow-50">

                        <td class="px-5 py-4 font-semibold">
                            {{ $cylinder->number }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $cylinder->gas_type }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $cylinder->equipment?->name ?? '—' }}
                        </td>

                        <td class="px-5 py-4 text-center font-bold">
                            {{ number_format($cylinder->current_lbs, 0) }} lb
                        </td>

                        {{-- ACCIÓN --}}

                    <td class="px-5 py-4 text-center">

                        <div class="flex justify-center items-center gap-2">

                            {{-- VER --}}

                            <a
                                href="{{ route('gas-cylinders.show', $cylinder) }}"
                                class="inline-flex items-center justify-center
                                    bg-blue-600 hover:bg-blue-700
                                    text-black
                                    px-4 py-2
                                    rounded-lg
                                    text-sm font-semibold
                                    whitespace-nowrap
                                    shadow-sm">

                                👁 Ver

                            </a>


                            {{-- MARCAR COMO ENTREGADO --}}

                            <form
                                action="{{ route('gas-cylinders.delivered', $cylinder) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm(
                                    '¿Confirmar que este cilindro ya fue entregado a la empresa?'
                                );">

                                @csrf

                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center
                                        bg-gray-700 hover:bg-gray-800
                                        text-black
                                        px-4 py-2
                                        rounded-lg
                                        text-sm font-semibold
                                        whitespace-nowrap
                                        shadow-sm">

                                    ✓ Entregado

                                </button>

                            </form>

                        </div>

                    </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="text-center text-gray-400 py-8">

                            No hay cilindros pendientes de entrega.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
<br><br>

{{-- ===================================================== --}}
{{-- ENTREGADOS --}}
{{-- ===================================================== --}}

<div class="bg-white rounded-2xl shadow-lg
            overflow-hidden mb-10">

    <div class="px-5 py-4 border-b bg-gray-100">

        <h2 class="text-xl font-bold text-gray-800">
            ⚫ Cilindros entregados
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Historial de cilindros que ya salieron del taller.
        </p>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-5 py-3 text-left">
                        Cilindro
                    </th>

                    <th class="px-5 py-3 text-left">
                        Gas
                    </th>

                    <th class="px-5 py-3 text-center">
                        Libras finales
                    </th>

                    <th class="px-5 py-3 text-center">
                        Acción
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($delivered as $cylinder)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-5 py-4 font-semibold">
                            {{ $cylinder->number }}
                        </td>

                        <td class="px-5 py-4">
                            {{ $cylinder->gas_type }}
                        </td>

                        <td class="px-5 py-4 text-center">
                            {{ number_format($cylinder->current_lbs, 0) }} lb
                        </td>

                        <td class="px-5 py-4 text-center">

                            <a
                                href="{{ route('gas-cylinders.show', $cylinder) }}"
                                class="bg-gray-700 hover:bg-gray-800
                                       text-white px-4 py-2
                                       rounded-lg text-sm font-semibold">

                                👁 Historial

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            class="text-center text-gray-400 py-8">

                            Todavía no existen cilindros entregados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection