<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GlobalControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function globalDashboard()
{
    $projects = Project::with(['movements.material'])->get();

    $chartData = $projects->map(function ($project) {

        $consumption = $project->movements->where('type', 'out');

        $totalCost = $consumption->sum(function ($m) {
            return $m->quantity * ($m->material->base_cost ?? 0);
        });

        return [
            'name' => $project->name,
            'y' => (float) $totalCost
        ];
    });

    return view('projects.global-dashboard', compact('chartData'));
}
    
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
