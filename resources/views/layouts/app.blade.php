<!DOCTYPE html>
<html>
<head>
    <title>Sistema Trazabilidad</title>
    @vite('resources/css/app.css')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-gray-900 text-white p-4">

        <h2 class="text-xl font-bold mb-6">Indumet CORP SAS</h2>

        <ul class="space-y-3">

            <li>
                <a href="/warehouse" class="block hover:bg-gray-700 p-2 rounded">
                    🚚 Almacén
                </a>
            </li>

            <li>
                <a href="/inventory" class="block hover:bg-gray-700 p-2 rounded">
                    📦 Inventario
                </a>
            </li>

            <li>
                <a href="/materials"
                    class="block hover:bg-gray-700 p-2 rounded">
                        📦 Crear Materiales
                </a>
            </li>

            <li>
                <a href="/projects"
                    class="block hover:bg-gray-700 p-2 rounded">
                        🏗 Proyectos
                </a>
            </li>

            <li>
                <a href="{{ route('projects.executive-dashboard') }}"
                    class="block hover:bg-gray-700 p-2 rounded">

                         📊 Analizis Gerencial 
                </a>
            </li>

            <li>

                <a href="{{ url('/workers') }}"
                    class="block hover:bg-gray-700 p-2 rounded">

                        👷 Trabajadores

                </a>

            </li>

            <li>

                <a href="{{ route('labor.index') }}"
                    class="block hover:bg-gray-700 p-2 rounded">

                        ⏱ Registro Horas

                </a>

            </li>

            <li>

                <a href="{{ route('material-log.index') }}"
                    class="block hover:bg-gray-700 p-2 rounded">

                    📦 Registro Materiales

                </a>

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