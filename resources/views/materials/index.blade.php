@extends('layouts.app')

@section('content')

<div class="flex justify-between mb-4">

    <h1 class="text-2xl font-bold">
        Materials
    </h1>

    <a href="{{ route('materials.create') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded">

        Nuevo material

    </a>

</div>

<table class="w-full bg-white shadow rounded">

    <thead>

        <tr class="border-b">

            <th class="p-3">Código</th>
            <th class="p-3">Nombre</th>
            <th class="p-3">Unidad</th>
            <th class="p-3">Costo</th>
            <th class="p-3">Acciones</th>

        </tr>

    </thead>

    <tbody>

        @foreach($materials as $material)

        <tr class="border-b">

            <td class="p-3">
                {{ $material->code }}
            </td>

            <td class="p-3">
                {{ $material->name }}
            </td>

            <td class="p-3">
                {{ $material->unit }}
            </td>

            <td class="p-3">
                {{ number_format($material->base_cost) }}
            </td>

            <td class="p-3">

                <a href="{{ route('materials.edit',$material) }}"
                   class="text-blue-500">

                    Editar

                </a>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection