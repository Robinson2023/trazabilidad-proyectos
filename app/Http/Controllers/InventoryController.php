<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Material;
use App\Models\Project;

class InventoryController extends Controller
{

    public function index()
{
    return view('inventory.index', [
        'inventories' => Inventory::with('material')->get(),
        'materials' => Material::all(),
        'projects' => Project::all()
    ]);
}
}