<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Movement;
use Illuminate\Http\Request;
use App\Models\Worker;

class ProjectController extends Controller
{
    public function dashboard()
    {
        $projects = Project::with(['movements.material'])->get();

        $data = $projects->map(function ($project) {

            $movements = $project->movements;

            $consumption = $movements->where('type', 'out');

            $totalQuantity = $consumption->sum('quantity');

            $totalCost = $consumption->sum(function ($m) {
                return $m->quantity * ($m->material->base_cost ?? 0);
            });

            $materials = $consumption->groupBy('material_id')->map(function ($group) {
                return [
                    'name' => $group->first()->material->name,
                    'quantity' => $group->sum('quantity'),
                ];
            });

            $alert = null;

            if ($project->estimated_hours && $totalQuantity > 0) {
                $alert = $totalQuantity > ($project->estimated_hours * 10);
            }

            return [
                'project' => $project,
                'total_quantity' => $totalQuantity,
                'total_cost' => $totalCost,
                'materials' => $materials,
                'alert' => $alert
            ];
        });

        return view('projects.dashboard', compact('data'));
    }

    public function index()
{
    $projects = \App\Models\Project::all();

    return view('projects.index', compact('projects'));
}

public function create()
{
    return view('projects.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'client' => 'nullable'
    ]);

    \App\Models\Project::create($request->all());

    return redirect()->route('projects.index');
}

public function projectDashboard(Project $project)
{
    $project->load(['movements.material', 'workers']);

    $movements = $project->movements->where('type', 'out');

    $totalQuantity = $movements->sum('quantity');

    $totalCost = $movements->sum(function ($m) {
        return $m->quantity * ($m->material->base_cost ?? 0);
    });

    $materials = $movements->groupBy('material_id')->map(function ($group) {
        return [
            'name' => $group->first()->material->name,
            'quantity' => $group->sum('quantity'),
            'cost' => $group->sum(function ($m) {
                return $m->quantity * ($m->material->base_cost ?? 0);
            }),
        ];
    });

    // ALERTA INVENTARIO
    $alert = false;

    if ($project->estimated_hours) {
        $threshold = $project->estimated_hours * 10;

        if ($totalQuantity > $threshold) {
            $alert = true;
        }
    }

    // PRESUPUESTO
    $budget = $project->budget ?? 0;

    $variance = 0;
    $percentage = 0;
    $status = 'OK';

    if ($budget > 0) {
        $variance = $totalCost - $budget;
        $percentage = ($variance / $budget) * 100;

        if ($percentage > 20) {
            $status = 'OVER';
        } elseif ($percentage > 0) {
            $status = 'WARNING';
        }
    }

    // 👷 COSTO MANO DE OBRA
    $workerCost = $project->workers->sum(function ($worker) {
        return $worker->pivot->hours * $worker->hour_rate;
    });

    return view('projects.dashboard', compact(
        'project',
        'totalQuantity',
        'totalCost',
        'materials',
        'alert',
        'budget',
        'variance',
        'percentage',
        'status',
        'workerCost'
    ));
}
public function show($id)
{
    $project = \App\Models\Project::findOrFail($id);

    return view('projects.show', compact('project'));
}

public function edit($id)
{
    $project = \App\Models\Project::findOrFail($id);

    return view('projects.edit', compact('project'));
}

public function update(Request $request, $id)
{
    $project = \App\Models\Project::findOrFail($id);

    $project->update($request->all());

    return redirect()->route('projects.index');
}

public function destroy($id)
{
    $project = \App\Models\Project::findOrFail($id);

    $project->delete();

    return redirect()->route('projects.index');
}

public function globalDashboard()
{
    $projects = \App\Models\Project::with(['movements.material'])->get();

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

public function executiveDashboard()
{
    $projects = Project::with(['movements.material'])->get();

    $data = $projects->map(function ($project) {

        $movements = $project->movements->where('type', 'out');

        $totalCost = $movements->sum(function ($m) {
            return $m->quantity * ($m->material->base_cost ?? 0);
        });

        $budget = $project->budget ?? 0;

        $variance = 0;
        $percentage = 0;

        if ($budget > 0) {
            $variance = $totalCost - $budget;
            $percentage = ($variance / $budget) * 100;
        }

        return [
            'name' => $project->name,
            'budget' => $budget,
            'cost' => $totalCost,
            'variance' => $variance,
            'percentage' => $percentage,
        ];
    });

    return view('projects.executive-dashboard', compact('data'));
}

public function assignWorkers($id)
{
    $project = Project::findOrFail($id);
    $workers = Worker::all();

    return view('projects.assign-workers', compact('project', 'workers'));
}

public function storeWorkers(Request $request, Project $project)
{
    $data = [];

    foreach ($request->workers as $workerId => $hours) {
        if ($hours > 0) {
            $data[$workerId] = ['hours' => $hours];
        }
    }

    $project->workers()->sync($data);

    return redirect()->route('projects.dashboard', $project);
}
}
