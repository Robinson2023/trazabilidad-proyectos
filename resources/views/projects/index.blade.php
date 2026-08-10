@extends('layouts.app')

@section('content')

{{-- ===================================================== --}}
{{-- CABECERA --}}
{{-- ===================================================== --}}

<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-3xl font-bold text-gray-800">
            📋 Proyectos
        </h1>

        <p class="text-gray-500 mt-1">
            Gestión y seguimiento de proyectos
        </p>

    </div>


    <a
        href="{{ route('projects.create') }}"
        class="bg-blue-500 hover:bg-blue-600
               text-white px-4 py-2 rounded">

        ➕ Nuevo Proyecto

    </a>

</div>


{{-- ===================================================== --}}
{{-- BUSCADOR --}}
{{-- ===================================================== --}}

<form
    method="GET"
    action="{{ route('projects.index') }}"
    class="flex gap-2 mb-6">

    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Buscar proyecto, cliente o estado..."
        class="border p-2 rounded flex-1">

    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded">

        Buscar

    </button>


    <a
        href="{{ route('projects.index') }}"
        class="bg-gray-500 text-white px-4 py-2 rounded">

        Limpiar

    </a>

</form>


{{-- ===================================================== --}}
{{-- PROYECTOS EN PROCESO --}}
{{-- ===================================================== --}}

<div class="bg-white rounded-xl shadow-md
            border border-gray-200 overflow-hidden mb-8">

    <div class="bg-slate-800 text-black px-5 py-4">

        <h2 class="text-xl font-bold">
            🏭 Proyectos en proceso
        </h2>

    </div>


    @if($activeProjects->isEmpty())

        <div class="p-8 text-center text-gray-500">

            No hay proyectos en proceso.

        </div>

    @else

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b bg-gray-50">

                        <th class="p-3 text-left">
                            Nombre
                        </th>

                        <th class="p-3 text-left">
                            Cliente
                        </th>

                        <th class="p-3 text-left">
                            Estado
                        </th>

                        <th class="p-3 text-center">
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($activeProjects as $project)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3 font-semibold">
                                {{ $project->name }}
                            </td>

                            <td class="p-3">
                                {{ $project->client }}
                            </td>

                            <td class="p-3">

                                @if($project->status == 'planned')

                                    <span class="px-3 py-1 rounded-full
                                                 bg-gray-100
                                                 text-gray-700 text-sm">

                                        ⚪ Planeado

                                    </span>

                                @elseif($project->status == 'active')

                                    <span class="px-3 py-1 rounded-full
                                                 bg-blue-100
                                                 text-blue-700 text-sm">

                                        🔵 Activo

                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full
                                                 bg-gray-100
                                                 text-gray-700 text-sm">

                                        {{ $project->status }}

                                    </span>

                                @endif

                            </td>


                            <td class="p-3">

                                <div class="flex flex-wrap
                                            gap-2 justify-center">

                                    <a
                                        href="{{ route('projects.show', $project) }}"
                                        class="bg-blue-600 hover:bg-blue-700
                                               text-white px-4 py-2 rounded">

                                        👁 Abrir

                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('projects.destroy', $project) }}"
                                        class="inline"
                                        onsubmit="return confirm(
                                            '¿Está seguro de eliminar este proyecto? Esta acción no se puede deshacer.'
                                        )">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="bg-red-500 hover:bg-red-600
                                                   text-white px-3 py-2
                                                   rounded text-sm font-medium">

                                            🗑 Eliminar

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>
<br>
<br>

{{-- ===================================================== --}}
{{-- PROYECTOS ENTREGADOS --}}
{{-- ===================================================== --}}

<div class="bg-white rounded-xl shadow-md
            border border-gray-200 overflow-hidden">

    <div class="bg-green-700 text-black px-5 py-4">

        <h2 class="text-xl font-bold">
            📦 Proyectos entregados
        </h2>

    </div>


    @if($finishedProjects->isEmpty())

        <div class="p-8 text-center text-gray-500">

            Todavía no hay proyectos entregados.

        </div>

    @else

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b bg-gray-50">

                        <th class="p-3 text-left">
                            Nombre
                        </th>

                        <th class="p-3 text-left">
                            Cliente
                        </th>

                        <th class="p-3 text-left">
                            Estado
                        </th>

                        <th class="p-3 text-center">
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($finishedProjects as $project)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3 font-semibold">
                                {{ $project->name }}
                            </td>

                            <td class="p-3">
                                {{ $project->client }}
                            </td>

                            <td class="p-3">

                                <span class="px-3 py-1 rounded-full
                                             bg-green-100
                                             text-green-700 text-sm">

                                    ✅ Terminado

                                </span>

                            </td>


                            <td class="p-3">

                                <div class="flex justify-center">

                                    <a
                                        href="{{ route('projects.show', $project) }}"
                                        class="bg-blue-600 hover:bg-blue-700
                                               text-white px-4 py-2 rounded">

                                        👁 Ver proyecto

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>

@endsection