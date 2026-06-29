@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- ENCABEZADO --}}
    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex justify-between items-start">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    {{ $project->name }}
                </h1>

                <p class="text-gray-500 mt-1">
                    Cliente: {{ $project->client }}
                </p>

            </div>

            <div class="text-right">

                <p class="text-sm text-gray-500">
                    Proyecto #{{ $project->id }}
                </p>

                <span class="inline-block mt-2 px-3 py-1 rounded-full text-sm font-semibold
                    @if($project->status == 'planned')
                        bg-yellow-100 text-yellow-700
                    @elseif($project->status == 'active')
                        bg-blue-100 text-blue-700
                    @elseif($project->status == 'completed')
                        bg-green-100 text-green-700
                    @else
                        bg-gray-100 text-gray-700
                    @endif">

                    @if($project->status == 'planned')
                        🟡 Planeado
                    @elseif($project->status == 'active')
                        🔵 En ejecución
                    @elseif($project->status == 'completed')
                        🟢 Finalizado
                    @else
                        {{ ucfirst($project->status) }}
                    @endif

                </span>

            </div>

        </div>

    </div>

    {{-- FILA 1: SALUD FINANCIERA --}}
    <div class="flex gap-4">

<div class="flex-1 bg-white shadow rounded-xl p-6 text-center flex flex-col justify-center min-h-[150px]">

    <div class="text-3xl mb-2">
        💰
    </div>

    <p class="text-gray-500 font-medium">
        Cotización
    </p>

    <p class="text-3xl font-bold mt-3">
        ${{ number_format($budget,0) }}
    </p>

</div>


        <div class="flex-1 bg-white shadow rounded-xl p-6 text-center flex flex-col justify-center min-h-[150px]">

            <div class="text-3xl mb-2">
              💰
            </div>

            <p class="text-gray-500 font-medium">
                💸 Costo Real
            </p>

            <p class="text-3xl font-bold mt-3">
                ${{ number_format($realCost,0) }}
            </p>

        </div>

            <div class="bg-white shadow rounded-xl p-6">

                <h2 class="text-sm text-gray-500">
                    🤝 Subcontratación
                </h2>

                <p class="text-2xl font-bold mt-2">
                    ${{ number_format($subcontractCost,0,',','.') }}
                </p>

            </div>

 <div class="flex-1 bg-white shadow rounded-xl p-6 text-center flex flex-col justify-center min-h-[150px]">
            <p class="text-gray-500 font-medium">
                📉 Desviación
            </p>

            <p class="text-3xl font-bold mt-2
                @if($percentage > 20)
                    text-red-600
                @elseif($percentage > 0)
                    text-yellow-600
                @else
                    text-green-600
                @endif">

                {{ number_format($percentage,2) }}%

            </p>

        </div>

    </div>

    @php
        $progress = $plannedHours > 0
            ? ($realHours / $plannedHours) * 100
            : 0;
    @endphp

    {{-- FILA 2: GESTIÓN DEL TIEMPO --}}
    <div class="flex gap-4">

        <div class="flex-1 bg-white shadow rounded-xl p-6 text-center flex flex-col justify-center min-h-[150px]">

            <p class="text-gray-500 font-medium">
                ⏱ Horas Presupuestadas
            </p>

            <p class="text-3xl font-bold mt-2">
                {{ number_format($plannedHours,2) }}
            </p>

        </div>

       <div class="flex-1 bg-white shadow rounded-xl p-6 text-center flex flex-col justify-center min-h-[150px]">

            <p class="text-gray-500 font-medium">
                👷 Horas Reales
            </p>

            <p class="text-3xl font-bold mt-2">
                {{ number_format($realHours,2) }}
            </p>

        </div>

       <div class="flex-1 bg-white shadow rounded-xl p-6 text-center flex flex-col justify-center min-h-[150px]">

            <p class="text-gray-500 font-medium">
                📊 Utilización
            </p>

            <p class="text-3xl font-bold mt-2
                @if($progress > 100)
                    text-red-600
                @elseif($progress > 80)
                    text-yellow-600
                @else
                    text-green-600
                @endif">

                {{ number_format($progress,1) }}%

            </p>

        </div>

    </div>

    {{-- BARRA DE HORAS --}}
    <div class="bg-white shadow rounded-xl p-6">

        <div class="flex justify-between mb-2">

            <span>

                {{ number_format($realHours,2) }}
                /
                {{ number_format($plannedHours,2) }}
                horas

            </span>

            <span>

                {{ number_format($progress,1) }}%

            </span>

        </div>

        <div class="w-full bg-gray-200 rounded-full h-5">

            <div
                class="h-5 rounded-full
                    @if($progress > 100)
                        bg-red-500
                    @elseif($progress > 80)
                        bg-yellow-500
                    @else
                        bg-blue-600
                    @endif"
                style="width: {{ min($progress,100) }}%;">

            </div>

        </div>

    </div>

    {{-- ALERTAS --}}
    @if($status === 'OVER')

        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">

            🔴 Proyecto sobre presupuesto.

        </div>

    @elseif($status === 'WARNING')

        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">

            🟡 Proyecto acercándose al límite presupuestal.

        </div>

    @else

        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">

            🟢 Proyecto bajo control.

        </div>

    @endif

    @if($alert)

        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">

            ⚠ Posible sobreconsumo detectado.

        </div>

    @endif

{{-- COSTOS --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white shadow rounded-xl p-6">

        <h2 class="text-xl font-bold mb-4">

            💵 Costos Directos

        </h2>

        <div class="space-y-4">

            <div class="flex justify-between">

                <span>Costo Materiales</span>

                <span class="font-bold">
                    ${{ number_format($totalCost,0) }}
                </span>

            </div>

            <div class="flex justify-between">

                <span>Costo Mano de Obra</span>

                <span class="font-bold">
                    ${{ number_format($workerCost,0) }}
                </span>

            </div>

        </div>

    </div>

    <div class="bg-white shadow rounded-xl p-6">

        <h2 class="text-xl font-bold mb-4">

            🚚 Costos Indirectos

        </h2>

        <table class="w-full">

            <tbody>

                <tr class="border-b">

                    <td class="py-2">Administrativos</td>

                    <td class="text-right">
                        ${{ number_format($project->administrative_cost,0) }}
                    </td>

                </tr>

                <tr class="border-b">

                    <td class="py-2">Transporte</td>

                    <td class="text-right">
                        ${{ number_format($project->transport_cost,0) }}
                    </td>

                </tr>

                <tr class="border-b">

                    <td class="py-2">Alimentación</td>

                    <td class="text-right">
                        ${{ number_format($project->food_cost,0) }}
                    </td>

                </tr>

                <tr>

                    <td class="py-2">

                        Otros

                        @if($project->other_description)

                            <br>

                            <small class="text-gray-500">
                                {{ $project->other_description }}
                            </small>

                        @endif

                    </td>

                    <td class="text-right">
                        ${{ number_format($project->other_cost,0) }}
                    </td>

                </tr>

                <tr class="border-t font-bold">

                    <td class="pt-3">

                        Total indirectos

                    </td>

                    <td class="pt-3 text-right">

                        ${{ number_format(
                            $project->administrative_cost +
                            $project->transport_cost +
                            $project->food_cost +
                            $project->other_cost,
                            0
                        ) }}

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

{{-- HORAS --}}
@php

    $progress = $plannedHours > 0
        ? ($realHours / $plannedHours) * 100
        : 0;

@endphp



{{-- MATERIALES --}}
<div class="bg-white shadow rounded-xl p-6">

    <h2 class="text-xl font-bold mb-4">

        📦 Materiales Utilizados

    </h2>

    <table class="w-full">

        <thead>

            <tr class="border-b">

                <th class="text-left py-3">Material</th>

                <th class="text-right py-3">Cantidad</th>

                <th class="text-right py-3">Costo</th>

            </tr>

        </thead>

        <tbody>

        @foreach($materials as $mat)

            <tr class="border-b">

                <td class="py-3">
                    {{ $mat['name'] }}
                </td>

                <td class="text-right">
                    {{ $mat['quantity'] }}
                </td>

                <td class="text-right">
                    ${{ number_format($mat['cost'],0) }}
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>



 <h2 class="text-xl font-bold mt-8 mb-3">
    🤝 Servicios Subcontratados
</h2>

<table class="w-full bg-white shadow rounded">

    <thead>

        <tr>

            <th class="p-3">Fecha</th>
            <th class="p-3">Proveedor</th>
            <th class="p-3">Servicio</th>
            <th class="p-3">Estado</th>
            <th class="p-3">Valor</th>

        </tr>

    </thead>

    <tbody>

    @forelse($project->subcontractings as $service)

        <tr class="border-b">

            <td class="p-3">
                {{ $service->service_date }}
            </td>

            <td class="p-3">
                {{ $service->supplier }}
            </td>

            <td class="p-3">
                {{ $service->service }}
            </td>

            <td class="p-3">

                @if($service->status == 'pending')
                    🟡 Pendiente
                @else
                    🟢 Pagado
                @endif

            </td>

            <td class="p-3 font-bold">
                ${{ number_format($service->amount,0,',','.') }}
            </td>

        </tr>

    @empty

        <tr>

            <td colspan="5"
                class="text-center p-4 text-gray-500">

                No hay servicios subcontratados.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

{{-- HORAS REGISTRADAS --}}
<div class="bg-white shadow rounded-xl p-6">

    <h2 class="text-xl font-bold mb-4">

        👷 Horas Registradas

    </h2>

    <table class="w-full">

        <thead>

            <tr class="border-b">

                <th class="text-left py-3">Fecha</th>

                <th class="text-left py-3">Trabajador</th>

                <th class="text-right py-3">Horas</th>

                <th class="text-right py-3">Tarifa</th>

                <th class="text-right py-3">Costo</th>

            </tr>

        </thead>

        <tbody>

        @forelse($laborEntries as $entry)

            <tr class="border-b">

                <td class="py-3">
                    {{ $entry->work_date }}
                </td>

                <td>
                    {{ $entry->worker->name }}
                </td>

                <td class="text-right">
                    {{ $entry->hours }}
                </td>

                <td class="text-right">
                    ${{ number_format($entry->worker->hour_rate,0) }}
                </td>

                <td class="text-right font-bold">
                    ${{ number_format(
                        $entry->hours * $entry->worker->hour_rate,
                        0
                    ) }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5"
                    class="text-center py-6 text-gray-500">

                    No hay horas registradas.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</div>

@endsection
