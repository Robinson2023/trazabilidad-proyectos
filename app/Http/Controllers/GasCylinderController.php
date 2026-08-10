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

        'equipment_id' => 'nullable|exists:gas_equipments,id',

        'worker_id' => 'nullable|exists:workers,id',

        'start_date' => 'required|date',

        'initial_lbs' => 'required|numeric|min:0',

        'cylinder_cost' => 'nullable|numeric|min:0',

        'notes' => 'nullable',

    ]);


    // 💰 CALCULAR COSTO POR LIBRA

    $data['cost_per_lb'] = null;

    if (
        !empty($data['cylinder_cost']) &&
        $data['initial_lbs'] > 0
    ) {

        $data['cost_per_lb'] =
            $data['cylinder_cost'] / $data['initial_lbs'];
    }


    // 🔄 SITUACIÓN DEL CILINDRO

    if (!empty($data['equipment_id'])) {

        $data['lifecycle_status'] = 'in_use';

    } else {

        $data['lifecycle_status'] = 'available';

    }

    $data['current_lbs'] = $data['initial_lbs'];

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
            $gasCylinder->load([
                'equipment',
                'worker',
                'consumptions.project',
                'consumptions.equipment',
                'consumptions.worker',
            ]);

            return view(
                'gas-cylinders.show',
                compact('gasCylinder')
            );
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

        'equipment_id' => 'nullable|exists:gas_equipments,id',

        'worker_id' => 'nullable|exists:workers,id',

        'start_date' => 'required|date',

        'initial_lbs' => 'required|numeric|min:0',

        'current_lbs' => 'required|numeric|min:0',

        'notes' => 'nullable',

        'cylinder_cost' => 'nullable|numeric|min:0',

    ]);

        $data['cost_per_lb'] = null;

        if (
            !empty($data['cylinder_cost']) &&
            $data['initial_lbs'] > 0
        ) {

            $data['cost_per_lb'] =
                $data['cylinder_cost'] /
                $data['initial_lbs'];
        }


        // 🔄 SITUACIÓN

        if (!empty($data['equipment_id'])) {

            $data['lifecycle_status'] = 'in_use';

        } else {

            $data['lifecycle_status'] = 'available';

        }


        $gasCylinder->update($data);

}

public function markPendingReturn(GasCylinder $gasCylinder)
{
    $gasCylinder->update([
        'lifecycle_status' => 'pending_return',
        'return_requested_at' => now(),
    ]);

    return redirect()
        ->route('gas-cylinders.index')
        ->with(
            'success',
            'Cilindro marcado como pendiente de entrega.'
        );
}


public function markDelivered(GasCylinder $gasCylinder)
{
    $gasCylinder->update([
        'lifecycle_status' => 'delivered',
        'delivered_at' => now(),
    ]);

    return redirect()
        ->route('gas-cylinders.index')
        ->with(
            'success',
            'Cilindro marcado como entregado.'
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
