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

        $in = Movement::where('material_id', $material->id)
            ->where('type', 'in')
            ->sum('quantity');

        $out = Movement::where('material_id', $material->id)
            ->where('type', 'out')
            ->sum('quantity');

        $stock = $in - $out;

        $material->stock = $stock;

        $material->status =
            $stock <= 0 ? 'critical' :
            ($stock < 10 ? 'low' : 'ok');

        return $material;
    });

    return view('inventory.index', [
        'materials' => $materials,
        'projects' => \App\Models\Project::all()
    ]);
}
}