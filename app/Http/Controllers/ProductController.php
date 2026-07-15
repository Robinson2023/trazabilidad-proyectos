<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

 public function store(Request $request)
{
    $data = $request->validate([

        'name' => 'required',

        'description' => 'nullable',

        'image' => 'nullable|image',

        'active' => 'required'

    ]);

    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time().'_'.$image->getClientOriginalName();

        $image->storeAs(
            'products',
            $imageName,
            'public'
        );

        $data['image'] = $imageName;
    }

    Product::create($data);

    return redirect()
        ->route('products.index')
        ->with('success','Producto creado correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

public function update(Request $request, Product $product)
{
    $data = $request->validate([

        'name' => 'required',

        'description' => 'nullable',

        'image' => 'nullable|image',

        'active' => 'required'

    ]);

    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time().'_'.$image->getClientOriginalName();

        $image->storeAs(
            'products',
            $imageName,
            'public'
        );

        $data['image'] = $imageName;
    }

    $product->update($data);

    return redirect()
            ->route('products.index')
            ->with('success','Producto actualizado correctamente.');
}

public function destroy(Product $product)
{
    $product->delete();

    return redirect()
            ->route('products.index')
            ->with('success','Producto eliminado correctamente.');
}

public function index()
{
    $products = Product::withCount('steps')
                ->orderBy('name')
                ->get();

    return view(
        'products.index',
        compact('products')
    );
}

public function create()
{
    return view('products.create');
}
}
