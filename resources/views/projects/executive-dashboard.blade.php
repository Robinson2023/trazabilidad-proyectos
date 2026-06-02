@extends('layouts.app')

@section('content')

<div id="chart"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {

Highcharts.chart('chart', {
    chart: { type: 'column' },

    title: {
        text: 'Comparativo de costos por proyecto'
    },

    xAxis: {
        categories: @json($data->pluck('name'))
    },

 series: [
    {
        name: 'Presupuesto',
        data: @json($data->pluck('budget'))
    },
    {
        name: 'Materiales',
        data: @json($data->pluck('material_cost'))
    },
    {
        name: 'Mano de obra',
        data: @json($data->pluck('worker_cost'))
    },
    {
        name: 'Costo Real',
        data: @json($data->pluck('cost'))
    }
]
});

});
</script>

<table class="w-full mt-6 bg-white shadow rounded">
    <thead>
        <tr>
            <th>Proyecto</th>
            <th>Presupuesto</th>
            <th>Materiales</th>
            <th>Mano de Obra</th>
            <th>Costo Real</th>
            <th>Desviación %</th>
        </tr>
    </thead>

    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{ $row['name'] }}</td>
            <td>${{ number_format($row['budget'],0) }}</td>
            <td>${{ number_format($row['material_cost'],0) }}</td>
            <td>${{ number_format($row['worker_cost'],0) }}</td>
            <td>${{ number_format($row['cost'],0) }}</td>
            <td>{{ number_format($row['percentage'],2) }}%</td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection