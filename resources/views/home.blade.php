@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Bienvenida --}}
    <div class="bg-gradient-to-r from-blue-700 to-blue-900 text-black rounded-xl shadow-lg p-8">

        <h1 class="text-4xl font-bold">

            ¡Buenos días,
            {{ auth()->user()->name }}!

        </h1>

        <p class="mt-3 text-blue-100 text-lg">

            Bienvenido al Centro de Operaciones de
            <strong>INDUMET CORP SAS</strong>

        </p>

        <p class="mt-2">

            {{ now()->format('d/m/Y') }}

        </p>

    </div>

    {{-- Frase --}}
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold mb-3">

            💡 Frase del día

        </h2>

        <p class="italic text-gray-700 text-lg">

            "La calidad nunca es un accidente; siempre es el resultado del compromiso de todo un equipo."

        </p>

    </div>

    {{-- Tres columnas --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Imagen --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <img
                src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=1200"
                class="w-full h-64 object-cover">

            <div class="p-4">

                <h3 class="font-bold text-lg">

                    🏭 Fabricación Metalmecánica

                </h3>

                <p class="text-gray-600">

                    La innovación comienza en el taller.

                </p>

            </div>

        </div>
<br>
        {{-- Video --}}
        <div class="bg-white rounded-xl shadow p-4">

            <h3 class="font-bold text-lg mb-3">

                🎥 Video recomendado

            </h3>

        <iframe
             class="w-full h-64 rounded"
            src="https://www.youtube.com/embed/yFKBQrUOUt0"
            title="Video"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen>
        </iframe>

        </div>
<br>
        {{-- Noticias --}}

<div class="bg-white rounded-xl shadow p-6">

    <h3 class="font-bold text-lg mb-4">
        📰 Actualidad Industrial
    </h3>

    @forelse($news as $item)

        <div class="border-b py-3">

            <a href="{{ $item['link'] }}"
               target="_blank"
               class="font-semibold text-blue-600 hover:underline">

                {{ $item['title'] }}

            </a>

            <p class="text-sm text-gray-500">

                {{ \Carbon\Carbon::parse($item['date'])->format('d/m/Y') }}

            </p>

        </div>

    @empty

        <p class="text-gray-500">

            No hay noticias disponibles.

        </p>

    @endforelse

</div>
<br>
<ul class="space-y-4 text-gray-700">

                <li>
                    🇨🇴 Economía colombiana continúa mostrando crecimiento industrial.
                </li>

                <li>
                    🌎 La automatización sigue transformando la manufactura mundial.
                </li>

                <li>
                    🤖 La Inteligencia Artificial continúa impulsando la productividad empresarial.
                </li>

            </ul>

        </div>

    </div>

    {{-- Accesos rápidos --}}

    {{--
  <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-xl font-bold mb-5">

            🚀 Accesos rápidos

        </h2>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">

            <a href="/projects"
               class="bg-blue-600 text-white rounded-lg p-5 text-center hover:bg-blue-700">

                🏗

                <br>

                Proyectos

            </a>

            <a href="/inventory"
               class="bg-green-600 text-white rounded-lg p-5 text-center hover:bg-green-700">

                📦

                <br>

                Inventario

            </a>

            <a href="/workers"
               class="bg-yellow-500 text-white rounded-lg p-5 text-center hover:bg-yellow-600">

                👷

                <br>

                Trabajadores

            </a>

            <a href="/subcontractings"
               class="bg-blue-600 text-white rounded-lg p-5 text-center hover:bg-purple-700">

                🤝

                <br>

                Subcontratos

            </a>

            <a href="/projects/executive-dashboard"
               class="bg-red-600 text-white rounded-lg p-5 text-center hover:bg-red-700">

                📊

                <br>

                Dashboard

            </a>

        </div>

    </div>
 --}}
</div>

@endsection