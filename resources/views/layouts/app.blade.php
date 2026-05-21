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

        <h2 class="text-xl font-bold mb-6">Almacén</h2>

        <ul class="space-y-3">

            <li>
                <a href="/warehouse" class="block hover:bg-gray-700 p-2 rounded">
                    🚚 Warehouse
                </a>
            </li>

            <li>
                <a href="/inventory" class="block hover:bg-gray-700 p-2 rounded">
                    📦 Inventory
                </a>
            </li>

            <li>
                <a href="/materials"
                    class="block hover:bg-gray-700 p-2 rounded">
                        📦 Materials
                </a>
            </li>

            <li>
                <a href="/projects"
                    class="block hover:bg-gray-700 p-2 rounded">
                        🏗 Projects
                </a>
            </li>

            <li>
                <a href="/projects/executive-dashboard"
                    class="block hover:bg-gray-700 p-2 rounded">

                         📊 Dashboard Gerencial
                </a>
            </li>

            <li>

                <a href="{{ url('/workers') }}"
                     class="block hover:bg-gray-700 p-2 rounded">

                        👷 Trabajadores

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