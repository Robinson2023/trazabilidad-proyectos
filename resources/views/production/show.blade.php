@extends('layouts.app')

@section('content')

{{-- CABECERA --}}
<div class="flex justify-between items-center mb-8">

    <div>

        <h1 class="text-4xl font-bold">
            🏭 Unidad de Fabricación
        </h1>
<br>
        <p class="text-black-600 mt-2">
            CONT-{{ $item->code }}
        </p>

    </div>

    <a href="{{ route('production.index',$item->project) }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">

        ← Volver

    </a>

</div>
<br>
{{-- BLOQUES SUPERIORES --}}
<div class="flex gap-6 mb-8">

    {{-- TARJETA INFORMACIÓN --}}
    <div class="w-1/2 bg-white rounded-2xl shadow-lg p-6">

        <h2 class="text-2xl font-bold mb-6">
            📋 Ficha de Fabricación
        </h2>

        <div class="space-y-5">

            <div>
                <p class="text-gray-500">Proyecto</p>
                <p class="text-xl font-bold">
                    {{ $item->project->name }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Producto</p>
                <p class="text-xl font-bold">
                    {{ $item->product->name }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Código</p>
                <p class="text-xl font-bold">
                    CONT-{{ $item->code }}
                </p>
            </div>

            <div>

                <p class="text-gray-500">Estado</p>

                @if($item->status == 'completed')

                    <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full">
                        🟢 Finalizado
                    </span>

                @elseif($item->status == 'in_progress')

                    <span class="bg-yellow-100 text-yellow-700 px-4 py-1 rounded-full">
                        🟡 En proceso
                    </span>

                @else

                    <span class="bg-gray-100 text-gray-700 px-4 py-1 rounded-full">
                        ⚪ Pendiente
                    </span>

                @endif

            </div>

            <div>

                <div class="flex justify-between mb-2">

                    <span>Avance General</span>

                    <strong>{{ $item->progress }}%</strong>

                </div>

                <div class="w-full h-4 bg-gray-200 rounded-full">

                    <div
                        class="bg-green-500 h-4 rounded-full"
                        style="width:{{ $item->progress }}%;">

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- TARJETA IMAGEN --}}
    <div class="w-48 bg-white rounded-2xl shadow-lg p-2">

        <div class="h-24 flex items-center justify-center">

            @if($item->product && $item->product->image)

                <img
                    src="{{ asset('storage/products/'.$item->product->image) }}"
                    alt="{{ $item->product->name }}"
                    class="h-24 object-contain">

            @else

                <span class="text-9xl">

                    📦

                </span>

            @endif

        </div>

    </div>

</div>
{{-- PROCESOS --}}
<div class="bg-white rounded-2xl shadow-lg mt-8">

    <div class="border-b px-2 py-2">

        <h2 class="text-2xl font-bold">

            📋 Procesos de Fabricación

        </h2>

    </div>

    <div class="divide-y">

        @foreach($item->steps as $step)

        <div class="flex justify-between items-center px-2 py-2">

            <div>

                <h3 class="font-bold text-lg">

                    {{ $step->productStep->name }}

                </h3>

                <p class="text-gray-500">

                    Orden {{ $step->productStep->order }}

                </p>

            </div>

            <div>

                @if($step->status=='completed')

                    <span class="text-green-600 font-bold">

                        🟢 Terminado

                    </span>

                @else

                    <form
                        action="{{ route('production.complete-step',$step) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <button
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                            Completar

                        </button>

                    </form>

                @endif

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection