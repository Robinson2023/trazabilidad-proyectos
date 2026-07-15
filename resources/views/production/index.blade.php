@extends('layouts.app')

@section('content')

{{-- CABECERA --}}
<div class="flex justify-between items-center border-b pb-5 mb-8">

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
        class="bg-blue-700 hover:bg-blue-800 text-black px-5 py-2 rounded-xl shadow">

        ← Volver

    </a>

</div>
<br>
{{-- TARJETAS --}}
<div class="flex flex-wrap justify-center gap-2">

@foreach($items as $item)

<a
    href="{{ route('production.show',$item) }}"
    class="block w-48 bg-white rounded-2xl border border-gray-200 shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden">

    {{-- Cabecera --}}
    <div class="bg-slate-800 text-white py-3">

        <h2 class="text-center text-xl font-bold">

            CONT-{{ $item->code }}

        </h2>

    </div>

{{-- Imagen del producto --}}
<div class="flex justify-center py-4">

    @if($item->project->product && $item->project->product->image)

        <img
            src="{{ asset('storage/products/'.$item->project->product->image) }}"
            alt="{{ $item->project->product->name }}"
            class="w-24 h-24 object-cover rounded-xl border shadow">

    @else

        <div class="w-20 h-20 rounded-xl bg-slate-100 flex items-center justify-center">

            <span class="text-4xl">

                📦

            </span>

        </div>

    @endif

</div>

    {{-- Barra de progreso --}}
    <div class="px-6">

        <div class="flex justify-between text-sm mb-2">

            <span>

                Avance

            </span>

            <strong>

                {{ $item->progress }}%

            </strong>

        </div>

        <div class="w-full bg-gray-200 rounded-full h-3">

            <div
                class="bg-green-500 h-3 rounded-full transition-all duration-500"
                style="width:{{ $item->progress }}%">

            </div>

        </div>

    </div>

    {{-- Estado --}}
    <div class="py-6 text-center">

        @if($item->status=='pending')

            <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700">

                ⚪ Pendiente

            </span>

        @elseif($item->status=='in_progress')

            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">

                🟡 En proceso

            </span>

        @else

            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">

                🟢 Terminado

            </span>

        @endif

    </div>

    {{-- Botón --}}
    <div class="px-5 pb-5">

        <div class="bg-blue-500 hover:bg-blue-500 text-white rounded-lg py-2 text-center font-semibold">

            Abrir Producción

        </div>

    </div>

</a>

@endforeach

</div>

@endsection