@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
Dashboard Gerencial de Proyectos
</h1>

<div id="container" style="width:100%; height:400px;"></div>

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