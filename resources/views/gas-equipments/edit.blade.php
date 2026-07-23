@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold">

                ✏️ Editar Equipo

            </h1>

            <p class="text-gray-500">

                Actualización de información del equipo.

            </p>

        </div>

        <a href="{{ route('gas-equipments.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-xl">

            ← Volver

        </a>

    </div>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700 rounded-xl p-4 mb-6">

            <ul class="list-disc ml-6">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('gas-equipments.update',$gasEquipment) }}"
        method="POST"
        class="bg-white rounded-2xl shadow-lg p-8 space-y-6">

        @csrf
        @method('PUT')

        <div>

            <label class="font-semibold">

                Código

            </label>

            <input
                type="text"
                name="code"
                value="{{ old('code',$gasEquipment->code) }}"
                class="w-full mt-2 border rounded-lg p-3">

        </div>

        <div>

            <label class="font-semibold">

                Nombre

            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name',$gasEquipment->name) }}"
                class="w-full mt-2 border rounded-lg p-3">

        </div>

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="font-semibold">

                    Marca

                </label>

                <input
                    type="text"
                    name="brand"
                    value="{{ old('brand',$gasEquipment->brand) }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">

                    Modelo

                </label>

                <input
                    type="text"
                    name="model"
                    value="{{ old('model',$gasEquipment->model) }}"
                    class="w-full mt-2 border rounded-lg p-3">

            </div>

        </div>

        <div>

            <label class="inline-flex items-center">

                <input
                    type="checkbox"
                    name="active"
                    {{ $gasEquipment->active ? 'checked' : '' }}
                    class="mr-2">

                Equipo Activo

            </label>

        </div>

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

            💾 Actualizar Equipo

        </button>

    </form>

</div>

@endsection