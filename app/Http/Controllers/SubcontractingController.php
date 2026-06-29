<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Subcontracting;
use Illuminate\Http\Request;

class SubcontractingController extends Controller
{
    public function index()
    {
        $subcontractings = Subcontracting::with('project')
            ->latest()
            ->get();

        return view(
            'subcontractings.index',
            compact('subcontractings')
        );
    }

    public function create()
    {
        $projects = Project::orderBy('name')->get();

        return view(
            'subcontractings.create',
            compact('projects')
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id'   => 'required|exists:projects,id',
            'supplier'     => 'required',
            'service'      => 'required',
            'description'  => 'nullable',
            'amount'       => 'required|numeric|min:0',
            'service_date' => 'required|date',
            'status'       => 'required',
        ]);

        Subcontracting::create($data);

        return redirect()
            ->route('subcontractings.index')
            ->with(
                'success',
                'Servicio subcontratado registrado correctamente.'
            );
    }

    public function edit(Subcontracting $subcontracting)
{
    $projects = Project::orderBy('name')->get();

    return view(
        'subcontractings.edit',
        compact('subcontracting', 'projects')
    );
}

public function update(Request $request, Subcontracting $subcontracting)
{
    $data = $request->validate([
        'project_id'   => 'required|exists:projects,id',
        'supplier'     => 'required',
        'service'      => 'required',
        'description'  => 'nullable',
        'amount'       => 'required|numeric|min:0',
        'service_date' => 'required|date',
        'status'       => 'required',
    ]);

    $subcontracting->update($data);

    return redirect()
        ->route('subcontractings.index')
        ->with(
            'success',
            'Servicio actualizado correctamente.'
        );
}

public function destroy(Subcontracting $subcontracting)
{
    $subcontracting->delete();

    return redirect()
        ->route('subcontractings.index')
        ->with(
            'success',
            'Servicio eliminado correctamente.'
        );
}
}

