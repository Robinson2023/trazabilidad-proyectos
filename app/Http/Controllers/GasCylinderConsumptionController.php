<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GasCylinder;
use App\Models\Project;
use App\Models\Worker;
use App\Models\GasCylinderConsumption;

class GasCylinderConsumptionController extends Controller
{
    public function create(GasCylinder $gasCylinder)
    {
        return view(
            'gas-consumptions.create',
            [
                'gasCylinder' => $gasCylinder,
                'projects' => Project::orderBy('name')->get(),
                'workers' => Worker::orderBy('name')->get()
            ]
        );
    }

    public function store(Request $request, GasCylinder $gasCylinder)
{
    $data = $request->validate([

        'project_id' => 'required|exists:projects,id',

        'worker_id' => 'required|exists:workers,id',

        'end_lbs' => [
            'required',
            'numeric',
            'min:0',
            'max:'.$gasCylinder->current_lbs,
        ],

        'notes' => 'nullable|string'

    ]);

    // Libras al iniciar el consumo
    $startLbs = $gasCylinder->current_lbs;

    // Libras consumidas
    $consumed = $startLbs - $data['end_lbs'];

    // Costo generado
    $totalCost = $consumed * $gasCylinder->cost_per_lb;

    // Guardar historial
    GasCylinderConsumption::create([

        'gas_cylinder_id' => $gasCylinder->id,

        'project_id' => $data['project_id'],

        'equipment_id' => $gasCylinder->equipment_id,

        'worker_id' => $data['worker_id'],

        'start_lbs' => $startLbs,

        'end_lbs' => $data['end_lbs'],

        'consumed_lbs' => $consumed,

        'cost_per_lb' => $gasCylinder->cost_per_lb,

        'total_cost' => $totalCost,

        'notes' => $data['notes'] ?? null

    ]);

    // Actualizar cilindro
    $gasCylinder->current_lbs = $data['end_lbs'];

    // Cambiar estado
    $gasCylinder->current_lbs = $data['end_lbs'];

    $gasCylinder->save();

    return redirect()
        ->route('gas-cylinders.index')
        ->with(
            'success',
            'Consumo registrado correctamente.'
        );
    }

    public function history(GasCylinder $gasCylinder)
    {
        $consumptions = $gasCylinder->consumptions()
            ->with([
                'project',
                'equipment',
                'worker'
            ])
            ->latest()
            ->get();

        return view(
            'gas-consumptions.history',
            compact(
                'gasCylinder',
                'consumptions'
            )
        );
    }
}