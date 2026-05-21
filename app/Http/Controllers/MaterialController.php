<?php

namespace App\Http\Controllers;

use App\Models\Material;
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
        $request->validate([
            'name'=>'required',
            'unit'=>'required',
            'base_cost'=>'required|numeric'
        ]);

        // último material
        $lastMaterial = Material::latest()->first();

        $nextNumber = $lastMaterial
            ? $lastMaterial->id + 1
            : 1;

        $code = 'MAT-' . str_pad(
            $nextNumber,
            5,
            '0',
            STR_PAD_LEFT
        );

        Material::create([
            'code'=>$code,
            'name'=>$request->name,
            'unit'=>$request->unit,
            'base_cost'=>$request->base_cost
        ]);

        return redirect()
            ->route('materials.index')
            ->with('success','Material creado');
    }

    public function edit(Material $material)
    {
        return view(
            'materials.edit',
            compact('material')
        );
    }

    public function update(
        Request $request,
        Material $material
    )
    {
        $request->validate([
            'name'=>'required',
            'unit'=>'required',
            'base_cost'=>'required|numeric'
        ]);

        $material->update([
            'name'=>$request->name,
            'unit'=>$request->unit,
            'base_cost'=>$request->base_cost
        ]);

        return redirect()
            ->route('materials.index');
    }
}