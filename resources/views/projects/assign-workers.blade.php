@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">
    Asignar Trabajadores a {{ $project->name }}
</h1>

<form method="POST"
      action="{{ route('projects.storeWorkers', $project->id) }}">

    @csrf

    @foreach($workers as $worker)

        <div class="mb-2">

            <label>
                {{ $worker->name }} ({{ $worker->role }})
            </label>

            <input

                type="number"
                step="0.01"
                name="workers[{{ $worker->id }}]"
                value="{{ $project->workers->firstWhere('id', $worker->id)?->pivot->hours ?? '' }}"
                placeholder="Horas"
                class="border p-1 rounded w-24">

        </div>

    @endforeach

    <button class="bg-blue-500 text-white px-4 py-2 rounded">
        Guardar asignación
    </button>

</form>

@endsection