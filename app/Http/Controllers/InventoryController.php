<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Movement;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class InventoryController extends Controller
{
public function index()
{
    $query = Material::query();

    if (request('search')) {

        $search = request('search');

        $query->where('name', 'like', "%{$search}%")
              ->orWhere('code', 'like', "%{$search}%");
    }

        $materials = $query->get()->map(function ($material) {

        $entries = Movement::where('material_id', $material->id)
            ->whereIn('type', ['in', 'return'])
            ->sum('quantity');

        $exits = Movement::where('material_id', $material->id)
            ->where('type', 'out')
            ->sum('quantity');

        $adjustments = Movement::where('material_id', $material->id)
            ->where('type', 'adjust')
            ->sum('quantity');

        $stock = $entries - $exits + $adjustments;

        $material->stock = $stock;

        if ($stock <= $material->critical_stock) {

    $material->status = 'critical';

        } elseif ($stock <= $material->warning_stock) {

            $material->status = 'warning';

        } else {

            $material->status = 'ok';

        }

        return $material;
    });

    return view('inventory.index', [
        'materials' => $materials,
        'projects' => \App\Models\Project::all()
    ]);
}
public function adjust(Material $material)
{
    $entries = Movement::where('material_id', $material->id)
        ->whereIn('type', ['in', 'return'])
        ->sum('quantity');

    $exits = Movement::where('material_id', $material->id)
        ->where('type', 'out')
        ->sum('quantity');

    $adjustments = Movement::where('material_id', $material->id)
        ->where('type', 'adjust')
        ->sum('quantity');

    $stock = $entries - $exits + $adjustments;

    return view(
        'inventory.adjust',
        compact('material', 'stock')
    );
}

public function storeAdjustment(Request $request, Material $material)
{
    $data = $request->validate([
        'new_stock' => 'required|numeric|min:0',
        'notes' => 'required|string',
    ]);

    // Calcular stock actual
    $entries = Movement::where('material_id', $material->id)
        ->whereIn('type', ['in', 'return'])
        ->sum('quantity');

    $exits = Movement::where('material_id', $material->id)
        ->where('type', 'out')
        ->sum('quantity');

    $adjustments = Movement::where('material_id', $material->id)
        ->where('type', 'adjust')
        ->sum('quantity');

    $currentStock = $entries - $exits + $adjustments;

    // Calcular diferencia con el inventario físico
    $difference = $data['new_stock'] - $currentStock;

    // Si no hay diferencia, no crear movimiento
    if ($difference == 0) {

        return redirect()
            ->route('inventory.index')
            ->with(
                'success',
                'El inventario ya coincide con la cantidad física. No fue necesario realizar ningún ajuste.'
            );
    }

    // Registrar ajuste
    Movement::create([
        'type' => 'adjust',
        'material_id' => $material->id,
        'project_id' => null,
        'user_id' => auth()->id(),
        'quantity' => $difference,
        'notes' => $data['notes'],
    ]);

    return redirect()
        ->route('inventory.index')
        ->with(
            'success',
            'Inventario ajustado correctamente.'
        );
}

}