
@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">

    Nuevo Servicio Subcontratado

</h1>

@if ($errors->any())

    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">

        Debes diligenciar correctamente todos los campos.

    </div>

@endif

<form method="POST"
      action="{{ route('subcontractings.store') }}"
      class="bg-white p-6 rounded shadow">

    @csrf

    <div class="mb-4">

        <label>Proyecto</label>

        <select name="project_id"
                class="w-full border p-2 rounded"
                required>

            <option value="">
                Seleccione...
            </option>

            @foreach($projects as $project)

                <option value="{{ $project->id }}">

                    {{ $project->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-4">

        <label>Proveedor</label>

        <input name="supplier"
               class="w-full border p-2 rounded"
               required>

    </div>

    <div class="mb-4">

        <label>Servicio</label>

        <input name="service"
               placeholder="Rolado, doblado, maquinado..."
               class="w-full border p-2 rounded"
               required>

    </div>

    <div class="mb-4">

        <label>Descripción</label>

        <textarea name="description"
                  class="w-full border p-2 rounded"></textarea>

    </div>

    <div class="mb-4">

        <label>Valor</label>

        <input type="number"
               step="0.01"
               name="amount"
               class="w-full border p-2 rounded"
               required>

    </div>

    <div class="mb-4">

        <label>Fecha del servicio</label>

        <input type="date"
               name="service_date"
               class="w-full border p-2 rounded"
               required>

    </div>

    <div class="mb-6">

        <label>Estado</label>

        <select name="status"
                class="w-full border p-2 rounded">

            <option value="pending">

                Pendiente

            </option>

            <option value="paid">

                Pagado

            </option>

        </select>

    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">

        Guardar

    </button>

</form>

@endsection

