<?php

namespace App\Http\Controllers;

use App\Models\LaborEntry;
use App\Models\Project;
use App\Models\Worker;
use Illuminate\Http\Request;

class LaborEntryController extends Controller
{
    public function index()
    {
        $entries = LaborEntry::with([
            'worker',
            'project'
        ])
        ->latest('work_date')
        ->get();

        return view('labor.index', compact('entries'));
    }

    public function create()
    {
        return view('labor.create', [
            'workers' => Worker::all(),
            'projects' => Project::all()
        ]);
    }

 public function store(Request $request)
{
    $data = $request->validate([
        'worker_id' => 'required|exists:workers,id',
        'project_id' => 'required|exists:projects,id',
        'work_date' => 'required|date',
        'hours' => 'required|numeric|min:0.25',
        'notes' => 'nullable|string'
    ]);

    $entry = LaborEntry::where('worker_id', $data['worker_id'])
    ->where('project_id', $data['project_id'])
    ->where('work_date', $data['work_date'])
    ->first();

if ($entry) {

    $entry->hours += $data['hours'];

    if (!empty($data['notes'])) {

        $entry->notes =
            trim(($entry->notes ?? '') . ' | ' . $data['notes']);
    }

    $entry->save();

    return redirect()
        ->route('labor.index')
        ->with(
            'success',
            'Horas acumuladas correctamente.'
        );
}

LaborEntry::create($data);
}
}