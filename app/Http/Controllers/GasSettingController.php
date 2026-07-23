<?php

namespace App\Http\Controllers;

use App\Models\GasSetting;
use Illuminate\Http\Request;

class GasSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $setting = GasSetting::first();

    if (!$setting) {

        $setting = GasSetting::create([

            'yellow_limit' => 25,

            'red_limit' => 10,

        ]);

    }

    return view(
        'gas-settings.index',
        compact('setting')
    );
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GasSetting $gasSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GasSetting $gasSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request)
{
    $data = $request->validate([

        'yellow_limit' => 'required|numeric|min:0',

        'red_limit' => 'required|numeric|min:0',

    ]);

    $setting = GasSetting::first();

    $setting->update($data);

    return back()->with(
        'success',
        'Configuración actualizada correctamente.'
    );
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GasSetting $gasSetting)
    {
        //
    }
}
