
@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Nuevo Trabajador
</h1>

@if ($errors->any()) <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4"> Debes diligenciar correctamente todos los campos obligatorios. </div> @endif

<form method="POST"
      action="{{ route('workers.store') }}"
      class="bg-white p-6 rounded shadow">

    @csrf

    <div class="mb-4">

        <label class="block mb-1 font-medium">
            Nombre
        </label>

        <input
            name="name"
            value="{{ old('name') }}"
            class="border p-2 w-full rounded"
            required>

    </div>

    <div class="mb-4">

        <label class="block mb-1 font-medium">
            Cargo
        </label>

        <input
            name="role"
            value="{{ old('role') }}"
            class="border p-2 w-full rounded"
            required>

    </div>

    <div class="mb-4">

        <label class="block mb-1 font-medium">
            Salario
        </label>

        <input
            type="number"
            step="0.01"
            id="salary"
            name="salary"
            value="{{ old('salary') }}"
            class="border p-2 w-full rounded"
            required>

    </div>

    <div class="mb-6">

        <label class="block mb-1 font-medium">
            Costo por hora
        </label>

        <input
            type="number"
            step="0.01"
            id="hour_rate"
            name="hour_rate"
            class="border p-2 w-full rounded bg-gray-100"
            readonly>

    </div>

    <button
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

        Guardar

    </button>

</form>

<script>

document.getElementById('salary').addEventListener('input', function () {

    let salary = parseFloat(this.value) || 0;

    let hourRate = (salary * 1.53) / 230;

    document.getElementById('hour_rate').value =
        hourRate.toFixed(2);

});

</script>

@endsection

