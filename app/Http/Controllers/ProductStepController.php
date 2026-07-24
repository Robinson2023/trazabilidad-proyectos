<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStep;
use Illuminate\Http\Request;
use App\Services\ProductionSynchronizationService;

class ProductStepController extends Controller
{

    public function index(Product $product)
    {
        $steps = $product->steps()
            ->orderBy('order')
            ->get();

        return view(
            'products.steps.index',
            compact('product', 'steps')
        );
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $nextOrder = $product->steps()->count() + 1;

        ProductStep::create([

            'product_id' => $product->id,

            'name' => $request->name,

            'order' => $nextOrder,

            'weight' => 0

        ]);

        return redirect()
            ->route('products.steps.index', $product)
            ->with('success', 'Proceso agregado correctamente.');
    }


public function create(Product $product)
{
    return view(
        'products.steps.create',
        compact('product')
    );
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

    public function sync(
    Product $product,
    ProductionSynchronizationService $service
)
{
    $created = $service->sync($product);

    if ($created == 0) {

        return back()->with(
            'success',
            'Todos los procesos ya estaban sincronizados.'
        );

    }

    return back()->with(
        'success',
        "Sincronización completada. Se agregaron {$created} procesos nuevos."
    );
}
}
