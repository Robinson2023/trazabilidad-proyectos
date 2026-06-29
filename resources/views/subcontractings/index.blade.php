@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-5">
    Subcontratación
</h1>

<a href="{{ route('subcontractings.create') }}"
   class="bg-blue-500 text-white px-4 py-2 rounded">

    Nuevo servicio

</a>

<table class="w-full mt-5 bg-white shadow rounded">

    <thead>

        <tr class="bg-gray-100">

            <th class="p-3">Proyecto</th>

            <th class="p-3">Proveedor</th>

            <th class="p-3">Servicio</th>

            <th class="p-3">Valor</th>

            <th class="p-3">Estado</th>

            <th class="p-3">Acciones</th>

        </tr>

    </thead>

    <tbody>

        @forelse($subcontractings as $item)

        <tr class="border-b">

            <td class="p-3">
                {{ $item->project->name }}
            </td>

            <td class="p-3">
                {{ $item->supplier }}
            </td>

            <td class="p-3">
                {{ $item->service }}
            </td>

            <td class="p-3">
                ${{ number_format($item->amount,0,',','.') }}
            </td>

            <td class="p-3">

                @if($item->status == 'pending')

                    🟡 Pendiente

                @else

                    🟢 Pagado

                @endif

            </td>


            <td class="p-3">

    <div class="flex gap-2">

        <a href="{{ route('subcontractings.edit', $item) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

            Editar

        </a>

                    <form method="POST"
                        action="{{ route('subcontractings.destroy', $item) }}"
                        onsubmit="return confirm('¿Está seguro de eliminar este servicio subcontratado? Esta acción no se puede deshacer.')">

                            @csrf
                            @method('DELETE')

                         <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

                             Eliminar

                         </button>

                    </form>

                 </div>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="5"
                class="text-center p-4 text-gray-500">

                No existen servicios subcontratados.

            </td>

        </tr>

        @endforelse

    </tbody>

</table>

@endsection

