<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
public function index()
{
    $query = Worker::query();

    if (request('search')) {

        $search = request('search');

        $query->where('name', 'like', "%{$search}%")
              ->orWhere('role', 'like', "%{$search}%");
    }

    $workers = $query->get();

    return view(
        'workers.index',
        compact('workers')
    );
}

    public function create()
    {
        return view('workers.create');
    }

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'role' => 'required',
        'salary' => 'required|numeric|min:0',
    ]);

    $data['hour_rate'] =
        ($data['salary'] * 1.53) / 230;

    Worker::create($data);

    return redirect()
        ->route('workers.index')
        ->with('success', 'Trabajador creado correctamente.');
}



    public function edit($id)
    {
        $worker = Worker::findOrFail($id);
        return view('workers.edit', compact('worker'));
    }


public function update(Request $request, $id)
{
    $worker = Worker::findOrFail($id);

    $data = $request->validate([
        'name' => 'required',
        'role' => 'required',
        'salary' => 'required|numeric|min:0',
    ]);

    $data['hour_rate'] =
        ($data['salary'] * 1.53) / 230;

    $worker->update($data);

    return redirect()
        ->route('workers.index')
        ->with('success', 'Trabajador actualizado correctamente.');
}



    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();

        return redirect()->route('workers.index');
    }
}