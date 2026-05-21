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
            name: 'Costo real',
            data: @json($data->pluck('cost'))
        }
    ]
});

});
</script>

@endsection