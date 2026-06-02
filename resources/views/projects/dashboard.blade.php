@extends('layouts.app')

@section('content')

<div class="grid grid-cols-3 gap-4 mb-6">

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Cotización</h2>
        <p class="text-xl font-bold">
            ${{ number_format($budget, 0) }}
        </p>
    </div>

    <div class="bg-white p-4 shadow rounded">
    <h2 class="text-gray-500">Costo real</h2>
    <p class="text-xl font-bold">
    ${{ number_format($realCost, 0) }}
    </p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Desviación</h2>
        <p class="text-xl font-bold">
            {{ number_format($percentage, 2) }}%
        </p>
    </div>

</div>

@if($status === 'OVER')
<div class="bg-red-100 text-red-700 p-3 rounded mb-4">
🔴 Proyecto sobre presupuesto
</div>

@elseif($status === 'WARNING')
<div class="bg-yellow-100 text-yellow-700 p-3 rounded mb-4">
🟡 Proyecto acercándose al límite
</div>

@else
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
🟢 Proyecto bajo control
</div>
@endif

<h1 class="text-2xl font-bold mb-4">
Proyecto: {{ $project->name }}
</h1>

<p class="text-gray-600 mb-6">
Cliente: {{ $project->client }}
</p>

<div class="grid grid-cols-5 gap-4 mb-6">

<div class="bg-white p-4 shadow rounded">
<h2 class="text-gray-500">Costo Materiales</h2>
<p class="text-xl font-bold">
${{ number_format($totalCost, 0) }}
</p>
</div>

<div class="bg-white p-4 shadow rounded">
<h2 class="text-gray-500">Costo Mano de Obra</h2>
<p class="text-xl font-bold">
${{ number_format($workerCost, 0) }}
</p>
</div>

<div class="bg-white p-4 shadow rounded">
<h2 class="text-gray-500">Horas Planeadas</h2>
<p class="text-xl font-bold">
{{ number_format($plannedHours, 2) }}
</p>
</div>

<div class="bg-white p-4 shadow rounded">
<h2 class="text-gray-500">Horas Reales</h2>
<p class="text-xl font-bold">
{{ number_format($realHours, 2) }}
</p>
</div>

<div class="bg-white p-4 shadow rounded">
<h2 class="text-gray-500">Estado</h2>
<p class="text-xl font-bold">

@if($project->status == 'planned')
    Planeado
@elseif($project->status == 'active')
    En ejecución
@elseif($project->status == 'completed')
    Finalizado
@else
    {{ $project->status }}
@endif

</p>
</div>

</div>

@if($alert)
<div class="bg-red-100 text-red-700 p-3 rounded mb-4">
⚠ Alerta: posible sobreconsumo detectado
</div>
@endif

<h2 class="text-xl font-bold mb-3">
Materiales usados
</h2>

<table class="w-full bg-white shadow rounded">

<thead>
<tr>
<th class="p-3">Material</th>
<th class="p-3">Cantidad</th>
<th class="p-3">Costo</th>
</tr>
</thead>

<tbody>

@foreach($materials as $mat)

<tr class="border-b">
<td class="p-3">{{ $mat['name'] }}</td>
<td class="p-3">{{ $mat['quantity'] }}</td>
<td class="p-3">${{ number_format($mat['cost'], 0) }}</td>
</tr>


@endforeach

</tbody>

</table>

<h2 class="text-xl font-bold mt-8 mb-3">
    Horas Registradas
</h2>

<table class="w-full bg-white shadow rounded">

    <thead>

        <tr>

            <th class="p-3">Fecha</th>

            <th class="p-3">Trabajador</th>

            <th class="p-3">Horas</th>

            <th class="p-3">Tarifa</th>

            <th class="p-3">Costo</th>

        </tr>

    </thead>

    <tbody>

    @forelse($laborEntries as $entry)

        <tr class="border-b">

            <td class="p-3">
                {{ $entry->work_date }}
            </td>

            <td class="p-3">
                {{ $entry->worker->name }}
            </td>

            <td class="p-3">
                {{ $entry->hours }}
            </td>

            <td class="p-3">
                ${{ number_format($entry->worker->hour_rate, 0) }}
            </td>

            <td class="p-3 font-bold">
                ${{ number_format(
                    $entry->hours * $entry->worker->hour_rate,
                    0
                ) }}
            </td>

        </tr>

    @empty

        <tr>

            <td colspan="5"
                class="text-center p-4 text-gray-500">

                No hay horas registradas

            </td>

        </tr>

    @endforelse

    </tbody>

</table>
@endsection