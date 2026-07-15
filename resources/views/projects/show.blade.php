@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-2">

    <div>

        <h1 class="text-5xl font-bold">

            🏗 {{ $project->name }}

        </h1>
<br>
        <p class="text-gray-500">

            Cliente: {{ $project->client }}

        </p>

    </div>

    <a
        href="{{ route('projects.index') }}"
        class="bg-blue-700 hover:bg-blue-800 text-blackpx-2 py-2 rounded-xl">

        ← Volver

    </a>

</div>

<br>

<div class="flex flex-wrap gap-2 mb-2">

    @include('components.summary-card',[

        'icon'=>'📦',

        'title'=>'Producto',

        'value'=>$project->product->name ?? '-'

    ])

    @include('components.summary-card',[

        'icon'=>'🏭',

        'title'=>'Cantidad',

        'value'=>$project->quantity

    ])

    @include('components.summary-card',[

        'icon'=>'📊',

        'title'=>'Estado',

        'value'=>ucfirst($project->status)

    ])

    @include('components.summary-card',[

        'icon'=>'💰',

        'title'=>'Presupuesto',

        'value'=>'$ '.number_format($project->budget,0,',','.')

    ])

</div>
<br>


<h2 class="text-2xl font-bold mb-2">

    Módulos

</h2>


<div class="flex flex-wrap gap-2">

@include('components.module-card',[

'url'=>route('production.index',$project),

'icon'=>'🏭',

'title'=>'Producción',

'description'=>'Fabricación y procesos',

'color'=>'bg-blue-600'

])


@include('components.module-card',[

'url'=>route('projects.dashboard',$project),

'icon'=>'📊',

'title'=>'Dashboard',

'description'=>'Estado financiero',

'color'=>'bg-green-600'

])


@include('components.module-card',[

'url'=>route('projects.edit',$project),

'icon'=>'⚙',

'title'=>'Configuración',

'description'=>'Editar proyecto',

'color'=>'bg-yellow-500'

])



@include('components.module-card',[

'url'=>route('projects.production.add',$project),

'icon'=>'➕',

'title'=>'Agregar Producción',

'description'=>'Agregar nuevas unidades o productos.',

'color'=>'bg-red-500'

])
</div>
@endsection