@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
Dashboard Gerencial de Proyectos
</h1>

<div id="container" style="width:100%; height:400px;"></div>

<table class="w-full mt-8 bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3">Proyecto</th>
            <th class="p-3">Costo Total</th>
        </tr>
    </thead>

    <tbody>

    @foreach($chartData as $item)

        <tr class="border-b">
            <td class="p-3">{{ $item['name'] }}</td>
            <td class="p-3">
                ${{ number_format($item['y'], 0) }}
            </td>
        </tr>

    @endforeach

    </tbody>
</table>

<script>

document.addEventListener('DOMContentLoaded', function () {

Highcharts.chart('container', {

chart: {
    type: 'column'
},

title: {
    text: 'Costo total por proyecto'
},

xAxis: {
    type: 'category'
},

yAxis: {
    title: {
        text: 'Costo ($)'
    }
},

series: [{
    name: 'Proyectos',
    colorByPoint: true,
    data: @json($chartData)
}]

});

});

</script>

@endsection