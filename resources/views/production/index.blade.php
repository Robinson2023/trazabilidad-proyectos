@extends('layouts.app')

@section('content')

<div class="w-96">

    {{-- ===================================================== --}}
    {{-- CABECERA --}}
    {{-- ===================================================== --}}

    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                🏭 Producción
            </h1>

            <p class="text-gray-500 mt-1">

                Proyecto:
                <strong>{{ $project->name }}</strong>

            </p>

        </div>


        <a
            href="{{ route('projects.index') }}"
            class="bg-blue-700 hover:bg-blue-800
                   text-white px-5 py-2 rounded-xl shadow">

            ← Volver

        </a>

    </div>

<br>
    {{-- ===================================================== --}}
    {{-- AVANCE GENERAL DEL PROYECTO --}}
    {{-- ===================================================== --}}

    <div class="w-full bg-white rounded shadow-md
                border border-gray-200 p-2 mb-2">

        <div class="flex justify-between items-center mb-2">

            <div>

                <h2 class="text-xl font-bold text-gray-800">
                    Avance general del proyecto
                </h2>

                <p class="text-sm text-gray-500">
                    Progreso de todos los procesos de producción
                </p>

            </div>


            <span class="text-3xl font-bold text-blue-700">

                {{ $project->production_progress }}%

            </span>

        </div>

<br>
        {{-- BARRA GENERAL --}}

        <div class="w-48 bg-gray-200 rounded-full h-3 overflow-hidden">

            <div
                class="bg-blue-600 h-5 rounded-full
                       transition-all duration-500"
                style="width: {{ $project->production_progress }}%">
            </div>

        </div>

<br>
{{-- ESTADO GENERAL --}}

<div class="mt-4">

    @if($project->production_progress >= 100 && $project->status != 'finished')

        <div class="flex flex-col md:flex-row
                    items-start md:items-center
                    justify-between gap-4">

            <span class="inline-flex items-center
                         px-4 py-2 rounded-full
                         bg-green-100 text-green-700
                         font-semibold">

                🟢 Producción terminada — lista para entregar

            </span>


            <form
                method="POST"
                action="{{ route('projects.finish', $project) }}">

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    onclick="return confirm(
                        '¿Confirmar que este proyecto fue entregado y debe pasar a proyectos terminados?'
                    )"
                    class="bg-green-600 hover:bg-green-700
                           text-white px-5 py-2
                           rounded-xl shadow
                           font-semibold">

                    📦 Marcar como entregado

                </button>

            </form>

        </div>


    @elseif($project->status == 'finished')

        <div class="flex items-center justify-between">

            <span class="inline-flex items-center
                         px-4 py-2 rounded-full
                         bg-green-100 text-green-700
                         font-semibold">

                ✅ Proyecto terminado y entregado

            </span>

        </div>


    @elseif($project->production_progress > 0)

        <span class="inline-flex items-center
                     px-4 py-2 rounded-full
                     bg-blue-100 text-blue-700
                     font-semibold">

            🔵 Producción en proceso

        </span>


    @else

        <span class="inline-flex items-center
                     px-4 py-2 rounded-full
                     bg-gray-100 text-gray-700
                     font-semibold">

            ⚪ Producción pendiente

        </span>

    @endif

</div>

<br>

{{-- ===================================================== --}}
{{-- PRODUCTOS --}}
{{-- ===================================================== --}}

<div class="flex flex-wrap gap-4">

    @foreach($items as $index => $item)

        {{-- TARJETA INDIVIDUAL --}}

        <div class="w-48 flex-shrink-0 bg-white rounded-xl shadow-md
                    border border-gray-200 overflow-hidden">

            {{-- IDENTIFICACIÓN --}}

            <div class="bg-slate-800 text-white p-3">

                <div class="flex items-center gap-2">

                    <span class="w-7 h-7 rounded-full
                                 bg-blue-600
                                 flex items-center justify-center
                                 font-bold text-xs flex-shrink-0">

                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}

                    </span>

                    <div class="min-w-0">

                        <p class="text-[10px] text-slate-300">
                            Producto
                        </p>

                        <h2 class="text-sm font-bold truncate">
                            CONT-{{ $item->code }}
                        </h2>

                    </div>

                </div>

            </div>


            {{-- IMAGEN --}}

            <div class="p-3">

                @if($item->project->product &&
                    $item->project->product->image)

                    <img
                        src="{{ asset('storage/products/'.$item->project->product->image) }}"
                        alt="{{ $item->project->product->name }}"
                        class="w-full h-32 object-cover
                               rounded-lg border shadow-sm">

                @else

                    <div class="w-full h-32
                                rounded-lg bg-slate-100
                                flex items-center justify-center">

                        <span class="text-4xl">
                            📦
                        </span>

                    </div>

                @endif

            </div>


            {{-- AVANCE --}}

            <div class="px-3">

                <div class="flex justify-between
                            items-center text-xs mb-1">

                    <span class="text-gray-500">
                        Avance
                    </span>

                    <strong>
                        {{ $item->progress }}%
                    </strong>

                </div>

                <div class="w-full bg-gray-200
                            rounded-full h-2">

                    <div
                        class="bg-green-500 h-2 rounded-full"
                        style="width: {{ $item->progress }}%">
                    </div>

                </div>

            </div>


            {{-- ESTADO --}}

            <div class="py-4 text-center">

                @if($item->status == 'pending')

                    <span class="inline-flex px-2 py-1
                                 rounded-full
                                 bg-gray-100
                                 text-gray-700
                                 text-xs">

                        ⚪ Pendiente

                    </span>

                @elseif($item->status == 'in_progress')

                    <span class="inline-flex px-2 py-1
                                 rounded-full
                                 bg-yellow-100
                                 text-yellow-700
                                 text-xs">

                        🟡 En proceso

                    </span>

                @else

                    <span class="inline-flex px-2 py-1
                                 rounded-full
                                 bg-green-100
                                 text-green-700
                                 text-xs">

                        🟢 Terminado

                    </span>

                @endif

            </div>


{{-- BOTÓN --}}
<div class="px-3 pb-3">

    <a
        href="{{ route('production.show', $item) }}"
        class="block
               w-full
               bg-blue-600
               hover:bg-blue-700
               text-white
               rounded-lg
               py-2
               text-center
               text-sm
               font-semibold
               transition
               cursor-pointer">

        Abrir Producción

    </a>

</div>

        </div>

    @endforeach

</div>

</div>

@endsection