@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Almacén - Movimientos
</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<form method="POST"
      action="{{ route('warehouse.movement') }}"
      class="space-y-4">

    @csrf

    <div>
        <label class="font-semibold">
            Código de material
        </label>

        <input
            id="material_code"
            type="text"
            name="material_code"
            class="w-full border p-2 rounded"
            placeholder="Escanear o escribir AL-001">
    </div>

    <div id="material-info"
         class="hidden bg-blue-50 border border-blue-200 p-3 rounded">

        <p>
            <strong>Código:</strong>
            <span id="material-code"></span>
        </p>

        <p>
            <strong>Material:</strong>
            <span id="material-name"></span>
        </p>

    </div>

 <select name="worker_id" class="w-full border p-2 rounded">

    <option value="">
        -- Seleccionar trabajador --
    </option>

    @foreach($workers as $worker)
        <option value="{{ $worker->id }}">
            {{ $worker->name }}
        </option>
    @endforeach

</select>
    <div>
        <label class="font-semibold">
            Tipo de movimiento
        </label>

            <select name="type"
                    class="w-full border p-2 rounded">

                <option value="in">
                    Entrada de inventario
                </option>

                <option value="out">
                    Salida a proyecto
                </option>

                <option value="return">
                    Devolución
                </option>

            </select>
    </div>

    <div>
        <label class="font-semibold">
            Proyecto
        </label>

        <select name="project_id"
                class="w-full border p-2 rounded">

            <option value="">
                -- Seleccionar --
            </option>

            @foreach($projects as $project)
                <option value="{{ $project->id }}">
                    {{ $project->name }}
                </option>
            @endforeach

        </select>
    </div>

    <div>
        <label class="font-semibold">
            Cantidad
        </label>

        <input type="number"
               step="0.01"
               name="quantity"
               class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="font-semibold">
            Notas
        </label>

        <textarea name="notes"
                  class="w-full border p-2 rounded"></textarea>
    </div>

    <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded w-full">

        Registrar movimiento

    </button>

</form>
<script>

document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('material_code');
    
    input.addEventListener('keydown', function(e) {

    if (e.key === 'Enter') {

        e.preventDefault();
        e.stopPropagation();

        console.log('ENTER DETECTADO');

        const code = this.value.trim();

        if (!code) return;

        fetch('/material/' + encodeURIComponent(code))
            .then(response => response.json())
            .then(data => {

                if (!data.found) {

                    alert('Material no encontrado');

                    document
                        .getElementById('material-info')
                        .classList.add('hidden');

                    return;
                }

                document
                    .getElementById('material-info')
                    .classList.remove('hidden');

                document
                    .getElementById('material-code')
                    .innerText = data.material.code;

                document
                    .getElementById('material-name')
                    .innerText = data.material.name;
            });

        return false;
    }

    const movementType = document.getElementById('movement_type');

    const projectSection = document.getElementById('project-section');

    const workerSection = document.getElementById('worker-section');

        function updateMovementForm() {

      if (movementType.value === 'in') {

        projectSection.style.display = 'none';
        workerSection.style.display = 'none';

       } else {

        projectSection.style.display = 'block';
        workerSection.style.display = 'block';

        }

}

        movementType.addEventListener('change', updateMovementForm);

        updateMovementForm();

});

    });

@endsection