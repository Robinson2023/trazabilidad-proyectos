<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Project;
use App\Services\MovementService;
use App\Models\Worker;

class WarehouseController extends Controller
{
    public function __construct(
        protected MovementService $service
    ) {}

public function index()
{
    return view('warehouse.index', [
        'projects' => Project::all(),
        'workers' => Worker::all()
    ]);
}

    public function storeMovement(Request $request)
    {
        $data = $request->validate([
            
            'type' => 'required|in:in,out,return,adjust',
            'material_code' => 'required|string',
            'project_id' => 'nullable|exists:projects,id',
            'quantity' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
            'worker_id' => 'nullable|exists:workers,id'
        ]);

        $material = Material::where('code', $data['material_code'])->firstOrFail();

        $movement = $this->service->register([
            'type' => $data['type'],
            'material_id' => $material->id,
            'project_id' => $data['project_id'],
            'quantity' => $data['quantity'],
            'barcode_scanned' => $data['material_code'],
            'user_id' => auth()->id(),
            'notes' => $data['notes'] ?? null,
             'worker_id' => $data['worker_id'] ?? null,
        ]);

        return back()->with('success', 'Movimiento registrado correctamente');
    }

    public function findMaterial($code)
{
    $material = Material::where(
        'code',
        $code
    )->first();

    if (!$material) {

        return response()->json([
            'found' => false
        ]);
    }

    return response()->json([
        'found' => true,
        'material' => $material
    ]);
}

}