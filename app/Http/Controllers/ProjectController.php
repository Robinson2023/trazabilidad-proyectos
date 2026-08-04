<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Movement;
use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\Product;
use App\Models\ProductionItem;
use App\Models\ProductionItemStep;
use App\Models\ProductStep;

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
    $products = Product::where('active', 1)
        ->orderBy('name')
        ->get();

    return view(
        'projects.create',
        compact('products')
    );
}
public function store(Request $request)
{
    $data = $request->validate([

        'name' => 'required',

        'client' => 'nullable',

        'product_id' => 'required|exists:products,id',

        'quantity' => 'required|integer|min:1',

        'budget' => 'nullable|numeric',

        'estimated_hours' => 'nullable|numeric',

        'administrative_cost' => 'nullable|numeric',

        'transport_cost' => 'nullable|numeric',

        'food_cost' => 'nullable|numeric',

        'other_cost' => 'nullable|numeric',

        'other_description' => 'nullable|string|max:255',

    ]);

    $project = Project::create($data);

for ($i = 1; $i <= $project->quantity; $i++) {

    $item = ProductionItem::create([

        'project_id' => $project->id,

        'product_id' => $project->product_id,

        'code' => str_pad($i, 3, '0', STR_PAD_LEFT),

        'status' => 'pending',

    ]);

    $steps = ProductStep::where(
        'product_id',
        $project->product_id
    )->orderBy('order')->get();

    foreach ($steps as $step) {

        ProductionItemStep::create([

            'production_item_id' => $item->id,

            'product_step_id' => $step->id,

            'status' => 'pending'

        ]);

    }

}

    return redirect()
        ->route('projects.index')
        ->with('success', 'Proyecto creado correctamente.');
}

public function projectDashboard(Project $project)
{
    $project->load([
    'movements.material',
    'workers',
    'laborEntries.worker',
    'subcontractings',
    'gasConsumptions',
]);

$workerCost = $project->laborEntries->sum(function ($entry) {
    return $entry->hours * $entry->worker->hour_rate;
});

// 🤝 COSTO SUBCONTRATACIÓN
$subcontractCost = $project->subcontractings->sum('amount');

// ⛽ COSTO DE GAS
$gasCost = $project->gasConsumptions->sum('total_cost');

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
    $subcontractCost +
    $gasCost;

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
    'subcontractCost',
    'gasCost',
    
));
}
public function show(Project $project)
{
    return view(
        'projects.show',
        compact('project')
    );
}

public function edit(Project $project)
{
    $products = Product::where('active', true)
        ->orderBy('name')
        ->get();

    $productionCreated = $project->productionItems()->exists();

    return view(
        'projects.edit',
        compact(
            'project',
            'products',
            'productionCreated'
        )
    );
}

public function update(Request $request, Project $project)
{
    $data = $request->validate([

        'name' => 'required',

        'client' => 'nullable',

        'product_id' => 'required|exists:products,id',

        'budget' => 'nullable|numeric',

        'estimated_hours' => 'nullable|numeric',

        'administrative_cost' => 'nullable|numeric',

        'transport_cost' => 'nullable|numeric',

        'food_cost' => 'nullable|numeric',

        'other_cost' => 'nullable|numeric',

        'other_description' => 'nullable|string|max:255',

    ]);

    $project->update($data);

    // Actualizar todas las unidades de fabricación
    $project->productionItems()->update([
        'product_id' => $project->product_id,
    ]);

    return redirect()
        ->route('projects.index')
        ->with('success','Proyecto actualizado correctamente.');
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
        $realCost = $materialCost + $workerCost + $gasCost;

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

        $gasCost = $project->gasConsumptions()
             ->sum('total_cost');

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

public function addProduction(Project $project)
{
    $products = Product::where('active',1)
                ->orderBy('name')
                ->get();

    return view(
        'projects.add-production',
        compact('project','products')
    );
}

public function storeProduction(Request $request, Project $project)
{
    $request->validate([

        'product_id' => 'required|exists:products,id',

        'quantity' => 'required|integer|min:1',

    ]);

    $product = Product::findOrFail($request->product_id);

$quantity = $request->quantity;

$lastItem = ProductionItem::where('project_id', $project->id)
    ->orderByDesc('id')
    ->first();

$next = 1;

if ($lastItem) {

    $next = intval($lastItem->code) + 1;

}

for ($i = 0; $i < $quantity; $i++) {

    $item = ProductionItem::create([

        'project_id' => $project->id,

        'product_id' => $product->id,

        'code' => str_pad($next + $i,3,'0',STR_PAD_LEFT),

        'status' => 'pending',

    ]);

    $steps = ProductStep::where('product_id',$product->id)
            ->orderBy('order')
            ->get();

    foreach($steps as $step){

        ProductionItemStep::create([

            'production_item_id'=>$item->id,

            'product_step_id'=>$step->id,

            'status'=>'pending'

        ]);

    }

}

// ← EL FOR TERMINA AQUÍ

return redirect()
    ->route('production.index',$project)
    ->with(
        'success',
        'Producción agregada correctamente.'
    );
}

}

