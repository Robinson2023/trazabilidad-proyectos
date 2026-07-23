<?php

namespace App\Http\Controllers;

use App\Models\GasEquipment;
use Illuminate\Http\Request;

class GasEquipmentController extends Controller
{
    public function index()
    {
        $equipments = GasEquipment::orderBy('id')->get();

        return view(
            'gas-equipments.index',
            compact('equipments')
        );
    }

    public function create()
    {
        return view('gas-equipments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([

            'code'  => 'required|unique:gas_equipments,code',

            'name'  => 'required|max:100',

            'brand' => 'nullable|max:100',

            'model' => 'nullable|max:100',

            'active'=> 'nullable'

        ]);

        $data['active'] = $request->has('active');

        GasEquipment::create($data);

        return redirect()
            ->route('gas-equipments.index')
            ->with(
                'success',
                'Equipo registrado correctamente.'
            );
    }

    public function edit(GasEquipment $gasEquipment)
    {
        return view(
            'gas-equipments.edit',
            compact('gasEquipment')
        );
    }

    public function update(Request $request, GasEquipment $gasEquipment)
    {
        $data = $request->validate([

            'code'  => 'required|unique:gas_equipments,code,' . $gasEquipment->id,

            'name'  => 'required|max:100',

            'brand' => 'nullable|max:100',

            'model' => 'nullable|max:100',

            'active'=> 'nullable'

        ]);

        $data['active'] = $request->has('active');

        $gasEquipment->update($data);

        return redirect()
            ->route('gas-equipments.index')
            ->with(
                'success',
                'Equipo actualizado.'
            );
    }

    public function destroy(GasEquipment $gasEquipment)
    {
        $gasEquipment->delete();

        return back()->with(
            'success',
            'Equipo eliminado.'
        );
    }
}