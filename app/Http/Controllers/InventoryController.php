<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Movement;
use Illuminate\Support\Facades\DB;

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

        $stock = $entries - $exits;

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
}