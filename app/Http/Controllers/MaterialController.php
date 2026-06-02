<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Movement;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'unit' => 'required|string',

            'initial_quantity' => 'nullable|numeric|min:0',

            'purchase_unit' => 'nullable|string',
            'purchase_quantity' => 'nullable|numeric',
            'purchase_cost' => 'nullable|numeric',


            // NUEVO MODELO DE COMPRA
            'purchase_unit' => 'nullable|string',
            'purchase_quantity' => 'nullable|numeric',
            'purchase_cost' => 'nullable|numeric',
        ]);

        // cálculo automático del costo unitario
        $data['base_cost'] = null;

        if (
            !empty($data['purchase_quantity']) &&
            !empty($data['purchase_cost']) &&
            $data['purchase_quantity'] > 0
        ) {
            $data['base_cost'] =
                $data['purchase_cost'] / $data['purchase_quantity'];
        }

$material = Material::create($data);

// Crear entrada automática de inventario
if (
    isset($data['initial_quantity']) &&
    $data['initial_quantity'] > 0
) {
    Movement::create([
        'type' => 'in',
        'material_id' => $material->id,
        'quantity' => $data['initial_quantity'],
        'barcode_scanned' => $material->code,
        'user_id' => auth()->id(),
        'notes' => 'Stock inicial'
    ]);
}

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material creado correctamente');
    }

    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'unit' => 'required|string',

            'initial_quantity' => 'nullable|numeric|min:0',

            'purchase_unit' => 'nullable|string',
            'purchase_quantity' => 'nullable|numeric',
            'purchase_cost' => 'nullable|numeric',
        ]);

        // recalcular costo unitario
        $data['base_cost'] = $material->base_cost;

        if (
            !empty($data['purchase_quantity']) &&
            !empty($data['purchase_cost']) &&
            $data['purchase_quantity'] > 0
        ) {
            $data['base_cost'] =
                $data['purchase_cost'] / $data['purchase_quantity'];
        }

        $oldQuantity = $material->initial_quantity ?? 0;

$material->update($data);

$newQuantity = $data['initial_quantity'] ?? 0;

$difference = $newQuantity - $oldQuantity;

if ($difference != 0) {

    Movement::create([
        'type' => $difference > 0 ? 'in' : 'out',
        'material_id' => $material->id,
        'quantity' => abs($difference),
        'barcode_scanned' => $material->code,
        'user_id' => auth()->id(),
        'notes' => 'Ajuste por edición'
    ]);
}

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material actualizado');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material eliminado');
    }
}