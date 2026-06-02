@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-5">

Nuevo Proyecto

</h1>

<form method="POST" action="{{ route('projects.store') }}"
      class="bg-white p-6 rounded shadow">

@csrf


<div class="mb-4">

<label>Nombre</label>
<input name="name"
       class="w-full border rounded p-2">

</div>

<div class="mb-4">

<label>Cliente</label>
<input name="client"
       class="w-full border rounded p-2">

</div>

<div class="mb-4">
<label>Presupuesto</label>

<input
type="number"
step="0.01"
name="budget"
class="w-full border rounded p-2">

</div>


<div class="mb-4">

<label>Horas estimadas</label>

<input
type="number"
name="estimated_hours"
class="w-full border rounded p-2">

</div>

<button class="bg-blue-500 text-white px-4 py-2 rounded">

Guardar

</button>

</form>

@endsection