@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">

Historial del cilindro

{{ $gasCylinder->number }}

</h1>

<div class="bg-white rounded-lg shadow">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-3">Fecha</th>

<th class="p-3">Proyecto</th>

<th class="p-3">Equipo</th>

<th class="p-3">Responsable</th>

<th class="p-3">Inicio</th>

<th class="p-3">Final</th>

<th class="p-3">Consumidas</th>

<th class="p-3">Costo</th>

</tr>

</thead>

<tbody>

@forelse($consumptions as $item)

<tr class="border-t">

<td class="p-3">

{{ $item->created_at->format('d/m/Y') }}

</td>

<td class="p-3">

{{ $item->project->name }}

</td>

<td class="p-3">

{{ $item->equipment->name }}

</td>

<td class="p-3">

{{ $item->worker->name }}

</td>

<td class="p-3">

{{ $item->start_lbs }}

</td>

<td class="p-3">

{{ $item->end_lbs }}

</td>

<td class="p-3 font-semibold">

{{ $item->consumed_lbs }}

</td>

<td class="p-3">

${{ number_format($item->total_cost,0) }}

</td>

</tr>

@empty

<tr>

<td colspan="8" class="text-center p-8">

No existen consumos registrados.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection