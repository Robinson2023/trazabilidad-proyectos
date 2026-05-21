@extends('layouts.app')

@section('content')

<div class="grid grid-cols-3 gap-4 mb-6">

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Presupuesto</h2>
        <p class="text-xl font-bold">
            ${{ number_format($budget, 0) }}
        </p>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-gray-500">Costo real</h2>
        <p class="text-xl font-bold">
            ${{ number_format($totalCost, 0) }}
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

<div class="grid grid-cols-3 gap-4 mb-6">

<div class="bg-white p-4 shadow rounded">
<h2 class="text-gray-500">Consumo total</h2>
<p class="text-xl font-bold">
{{ $totalQuantity }}
</p>
</div>

<div class="bg-white p-4 shadow rounded">
<h2 class="text-gray-500">Costo real</h2>
<p class="text-xl font-bold">
${{ number_format($totalCost, 0) }}
</p>
</div>

<div class="bg-white p-4 shadow rounded">
<h2 class="text-gray-500">Estado</h2>
<p class="text-xl font-bold">
{{ $project->status }}
</p>
</div>

<div class="bg-white p-4 shadow rounded">
    <h2 class="text-gray-500">Costo Mano de Obra</h2>
    <p class="text-xl font-bold">
        ${{ number_format($workerCost, 0) }}
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

@endsection