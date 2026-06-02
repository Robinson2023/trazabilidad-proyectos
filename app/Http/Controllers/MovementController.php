<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovementService;

class MovementController extends Controller
{
    public function __construct(
        protected MovementService $service
    ) {}

 public function store(Request $request)
{
    $data = $request->validate([
        'type' => 'required|in:in,out,return,adjust',
        'material_id' => 'required|exists:materials,id',
        'project_id' => 'nullable|exists:projects,id',
        'quantity' => 'required|numeric|min:0.01',
        'barcode_scanned' => 'nullable|string',
        'notes' => 'nullable|string'
    ]);

    // Regla: salida debe tener proyecto
    if ($data['type'] === 'out' && !$data['project_id']) {
        return back()->withErrors([
            'project_id' => 'Los movimientos de salida deben tener un proyecto.'
        ]);
    }

    $data['user_id'] = auth()->id();

    $movement = $this->service->register($data);

    return response()->json([
        'message' => 'Movimiento registrado correctamente',
        'data' => $movement
    ]);
}
    
}
