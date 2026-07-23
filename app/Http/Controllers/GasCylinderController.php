<?php

namespace App\Http\Controllers;

use App\Models\GasCylinder;
use Illuminate\Http\Request;
use App\Models\GasEquipment;
use App\Models\Worker;

class GasCylinderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $cylinders = GasCylinder::with([
        'equipment',
        'worker'
    ])
    ->orderBy('number')
    ->get();

    return view(
        'gas-cylinders.index',
        compact('cylinders')
    );
}

    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    $equipments = GasEquipment::orderBy('name')->get();

    $workers = Worker::orderBy('name')->get();

    return view(
        'gas-cylinders.create',
        compact(
            'equipments',
            'workers'
        )
    );
}
    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $data = $request->validate([

        'number' => 'required|unique:gas_cylinders,number',

        'gas_type' => 'required',

        'equipment_id' => 'required|exists:gas_equipments,id',

        'worker_id' => 'required|exists:workers,id',

        'start_date' => 'required|date',

        'initial_lbs' => 'required|numeric|min:0',

        'current_lbs' => 'required|numeric|min:0',

        'notes' => 'nullable'

    ]);

    GasCylinder::create($data);

    return redirect()
            ->route('gas-cylinders.index')
            ->with(
                'success',
                'Cilindro registrado correctamente.'
            );
}
    /**
     * Display the specified resource.
     */
    public function show(GasCylinder $gasCylinder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(GasCylinder $gasCylinder)
{
    $equipments = GasEquipment::orderBy('name')->get();

    $workers = Worker::orderBy('name')->get();

    return view(
        'gas-cylinders.edit',
        compact(
            'gasCylinder',
            'equipments',
            'workers'
        )
    );
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, GasCylinder $gasCylinder)
{
    $data = $request->validate([

        'number' => 'required|unique:gas_cylinders,number,' . $gasCylinder->id,

        'gas_type' => 'required',

        'equipment_id' => 'required|exists:gas_equipments,id',

        'worker_id' => 'required|exists:workers,id',

        'start_date' => 'required|date',

        'initial_lbs' => 'required|numeric|min:0',

        'current_lbs' => 'required|numeric|min:0',

        'notes' => 'nullable'

    ]);

    $gasCylinder->update($data);

    return redirect()
        ->route('gas-cylinders.index')
        ->with(
            'success',
            'Cilindro actualizado correctamente.'
        );
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(GasCylinder $gasCylinder)
{
    $gasCylinder->delete();

    return redirect()
        ->route('gas-cylinders.index')
        ->with(
            'success',
            'Cilindro eliminado correctamente.'
        );
}
}
