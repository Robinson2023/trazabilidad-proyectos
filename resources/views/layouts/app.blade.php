<!DOCTYPE html>
<html>
<head>
    <title>Sistema Trazabilidad</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-gray-900 text-white p-4">

        <a href="{{ route('home') }}"
   class="block text-xl font-bold mb-6 hover:text-blue-300 transition">

    🏭 INDUMET CORP SAS

    </a>

        <ul class="space-y-3">

            @if(
    auth()->user()->role === 'admin' ||
    auth()->user()->role === 'management' ||
    auth()->user()->role === 'warehouse'
)

<li>

    <a href="/warehouse"
        class="block hover:bg-gray-700 p-2 rounded">

        🚚 Almacén

    </a>

</li>

@endif

           @if(
    auth()->user()->role === 'admin' ||
    auth()->user()->role === 'management' ||
    auth()->user()->role === 'warehouse'
)

<li>
    <a href="/inventory"
       class="block hover:bg-gray-700 p-2 rounded">

        📦 Inventario

    </a>
</li>

@endif

@if(
    auth()->user()->role === 'admin' ||
    auth()->user()->role === 'management' ||
    auth()->user()->role === 'warehouse'
)

<li>
    <a href="/materials"
       class="block hover:bg-gray-700 p-2 rounded">

        📦 Crear Materiales

    </a>
</li>

<li>

    <a href="{{ route('products.index') }}"
       class="block hover:bg-gray-700 p-2 rounded">

        📚 Productos

    </a>

</li>

@endif

@if(
    in_array(
        auth()->user()->role,
        ['admin','management','supervisor']
    )
)

<li>

    <a href="/projects"
       class="block hover:bg-gray-700 p-2 rounded">

        🏗 Proyectos

    </a>

</li>

@endif

            @if(
    auth()->user()->role === 'admin' ||
    auth()->user()->role === 'management'
)

<li>

    <a href="{{ route('projects.executive-dashboard') }}"
        class="block hover:bg-gray-700 p-2 rounded">

        📊 Dashboard Gerencial

    </a>

</li>

@endif
 @if(
    in_array(
        auth()->user()->role,
        ['admin','management']
    )
)

<li>

    <a href="{{ url('/workers') }}"
       class="block hover:bg-gray-700 p-2 rounded">

        👷 Trabajadores

    </a>

</li>

@endif

            @if(
    in_array(
        auth()->user()->role,
        ['admin','worker','management','supervisor']
    )
)

<li>

    <a href="{{ route('labor.index') }}"
        class="block hover:bg-gray-700 p-2 rounded">

        ⏱ Registro Horas

    </a>

</li>

@endif

@if(
    auth()->user()->role === 'admin' ||
    auth()->user()->role === 'management' ||
    auth()->user()->role === 'warehouse'
)

<li>

    <a href="{{ route('material-log.index') }}"
       class="block hover:bg-gray-700 p-2 rounded">

        📦 Registro Materiales

    </a>

</li>

@endif

@if(
    in_array(
        auth()->user()->role,
        ['admin','management','warehouse']
    )
)

<li>

    <a href="{{ route('subcontractings.index') }}"
       class="block hover:bg-gray-700 p-2 rounded">

        🤝 Subcontratación

    </a>

</li>

@endif

@if(
    auth()->user()->role === 'admin' ||
    auth()->user()->role === 'management'

)

<li>

    <a href="{{ route('users.index') }}"
       class="block hover:bg-gray-700 p-2 rounded">

        👤 Usuarios

    </a>

</li>

@endif


      <hr class="border-gray-700 my-4">

<li>

    <div class="text-sm text-gray-300 px-2">

        {{ auth()->user()->name }}

        <br>

        <span class="text-xs uppercase">
            {{ auth()->user()->role }}
        </span>

    </div>

</li>

<li>

    <form method="POST"
          action="{{ route('logout') }}">

        @csrf

        <button
            type="submit"
            class="block w-full text-left hover:bg-red-700 p-2 rounded">

            🚪 Cerrar Sesión

        </button>

    </form>

</li>

        </ul>

 

    </div>

    <!-- CONTENIDO -->
    <div class="flex-1 p-6">

        @yield('content')

    </div>

</div>

 
</body>
</html>