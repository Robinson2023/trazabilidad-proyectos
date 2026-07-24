<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProductionItem;
use App\Models\ProductionItemStep;

class ProductionController extends Controller
{
    public function index(Project $project)
    {
        $items = $project->productionItems()
                         ->orderBy('code')
                         ->get();

        return view(
            'production.index',
            compact('project','items')
        );
    }

    public function show(ProductionItem $item)
{
    $item->load([
    'project',
    'product',
    'steps.productStep'
]);

    return view(
        'production.show',
        compact('item')
    );
}

public function completeStep(ProductionItemStep $step)
{
    $step->update([
        'status' => 'completed'
    ]);

    $item = $step->productionItem;

    $total = $item->steps()->count();

    $completed = $item->steps()
        ->where('status', 'completed')
        ->count();

    $status = 'pending';

    if ($completed > 0 && $completed < $total) {
        $status = 'in_progress';
    }

    if ($completed == $total) {
        $status = 'completed';
    }

    $item->update([
        'status' => $status
    ]);

    return back()->with(
        'success',
        'Proceso completado.'
    );
}
}