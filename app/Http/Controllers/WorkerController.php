<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::all();
        return view('workers.index', compact('workers'));
    }

    public function create()
    {
        return view('workers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'nullable',
            'hour_rate' => 'required|numeric|min:0'
        ]);

        Worker::create($request->all());

        return redirect()->route('workers.index');
    }

    public function edit($id)
    {
        $worker = Worker::findOrFail($id);
        return view('workers.edit', compact('worker'));
    }

    public function update(Request $request, $id)
    {
        $worker = Worker::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'role' => 'nullable',
            'hour_rate' => 'required|numeric|min:0'
        ]);

        $worker->update($request->all());

        return redirect()->route('workers.index');
    }

    public function destroy($id)
    {
        $worker = Worker::findOrFail($id);
        $worker->delete();

        return redirect()->route('workers.index');
    }
}