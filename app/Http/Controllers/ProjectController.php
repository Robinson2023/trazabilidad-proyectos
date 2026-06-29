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
    $query = Project::query();

    if (request('search')) {

        $search = request('search');

        $query->where('name', 'like', "%{$search}%")
              ->orWhere('client', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%");
    }

    $projects = $query->get();

    return view(
        'projects.index',
        compact('projects')
    );
}
public function create()
{
    return view('projects.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'client' => 'nullable',
        'budget' => 'nullable|numeric',
        'estimated_hours' => 'nullable|numeric',
        'administrative_cost' => 'nullable|numeric',
        'transport_cost'      => 'nullable|numeric',
        'food_cost'           => 'nullable|numeric',
        'other_cost'          => 'nullable|numeric',
        'other_description'   => 'nullable|string|max:255'
    ]);

    Project::create($request->all());

    Project::create($request->only([
        'name','client','budget','estimated_hours'
    ]));

    return redirect()->route('projects.index');
}

public function projectDashboard(Project $project)
{
    $project->load([
    'movements.material',
    'workers',
    'laborEntries.worker',
    'subcontractings'
]);

$workerCost = $project->laborEntries->sum(function ($entry) {
    return $entry->hours * $entry->worker->hour_rate;
});

// 🤝 COSTO SUBCONTRATACIÓN
$subcontractCost = $project->subcontractings->sum('amount');

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

  

 // 📋 HORAS PRESUPUESTADAS
$plannedHours = $project->workers->sum(function ($worker) {
    return $worker->pivot->hours;
});

// ⏱ HORAS REALES
$realHours = $project->laborEntries->sum('hours');

// 👷 COSTO REAL DE MANO DE OBRA
$workerCost = $project->laborEntries->sum(function ($entry) {
    return $entry->hours * $entry->worker->hour_rate;
});

// 💰 COSTO TOTAL REAL
$totalIndirect =
    ($project->administrative_cost ?? 0) +
    ($project->transport_cost ?? 0) +
    ($project->food_cost ?? 0) +
    ($project->other_cost ?? 0);

$realCost =
    $totalCost +
    $workerCost +
    $totalIndirect +
    $subcontractCost;

  // PRESUPUESTO
    $budget = $project->budget ?? 0;

    $variance = 0;
    $percentage = 0;
    $status = 'OK';

    if ($budget > 0) {

    $variance = $realCost - $budget;

    $percentage = ($variance / $budget) * 100;

    if ($percentage > 20) {
        $status = 'OVER';
    } elseif ($percentage > 0) {
        $status = 'WARNING';
    }
}

$laborEntries = $project->laborEntries()
    ->with('worker')
    ->orderBy('work_date', 'desc')
    ->get();

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
    'workerCost',
    'realCost',
    'plannedHours',
    'realHours',
    'laborEntries',
    'subcontractCost'
));
}
public function show(Project $project)
{
    return view('projects.show', compact('project'));
}

public function edit(Project $project)
{
    return view('projects.edit', compact('project'));
}

public function update(Request $request, Project $project)
{
    $request->validate([
        'name' => 'required',
        'client' => 'nullable',
        'budget' => 'nullable|numeric',
        'estimated_hours' => 'nullable|numeric',
        'administrative_cost' => 'nullable|numeric',
        'transport_cost'      => 'nullable|numeric',
        'food_cost'           => 'nullable|numeric',
        'other_cost'          => 'nullable|numeric',
        'other_description'   => 'nullable|string|max:255'
    ]);

   $project->update($request->only([
    'name',
    'client',
    'budget',

    'administrative_cost',
    'transport_cost',
    'food_cost',
    'other_cost',
    'other_description'
]));

    return redirect()->route('projects.index');
}
public function destroy(Project $project)
{
    $project->delete();

    return redirect()->route('projects.index');
}

public function globalDashboard()
{
    $projects = Project::with([
        'movements.material',
        'workers'
    ])->get();

    $chartData = $projects->map(function ($project) {

        // COSTO MATERIALES
        $materialCost = $project->movements
            ->where('type', 'out')
            ->sum(function ($m) {
                return $m->quantity * ($m->material->base_cost ?? 0);
            });

        // COSTO MANO DE OBRA
        $workerCost = $project->workers->sum(function ($worker) {
            return $worker->pivot->hours * $worker->hour_rate;
        });

        // COSTO TOTAL REAL
        $realCost = $materialCost + $workerCost;

        return [
    'name' => $project->name,

    'material_cost' => $materialCost,

    'worker_cost' => $workerCost,

    'total_cost' => $realCost,

    'y' => (float) $realCost
];
    });

    return view('projects.global-dashboard', compact('chartData'));
}

public function executiveDashboard()
{
    $projects = Project::with(['movements.material', 'workers'])->get();

    $data = $projects->map(function ($project) {

        $movements = $project->movements->where('type', 'out');

        // COSTO MATERIALES
        $totalCost = $movements->sum(function ($m) {
            return $m->quantity * ($m->material->base_cost ?? 0);
        });

        // COSTO MANO DE OBRA
        $workerCost = $project->workers->sum(function ($worker) {
            return $worker->pivot->hours * $worker->hour_rate;
        });

        // COSTO REAL
        $realCost = $totalCost + $workerCost;

        $budget = $project->budget ?? 0;

        $variance = 0;
        $percentage = 0;

        if ($budget > 0) {
            $variance = $realCost - $budget;
            $percentage = ($variance / $budget) * 100;
        }

        return [
            'name' => $project->name,
            'budget' => $budget,

            'material_cost' => $totalCost,

            'worker_cost' => $workerCost,

            'cost' => $realCost,

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
