<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailySchedule;
use App\Models\Worker;
use App\Models\Project;

class DailyScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = request('date', now()->toDateString());

        $schedules = DailySchedule::with([
            'worker',
            'project',
            'creator'
        ])
        ->whereDate('date', $date)
        ->orderBy('start_time')
        ->get();

        return view(
            'daily-schedules.index',
            compact(
                'schedules',
                'date'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $workers = Worker::orderBy('name')->get();

        $projects = Project::orderBy('name')->get();

        return view(
            'daily-schedules.create',
            compact(
                'workers',
                'projects'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'date' => [
                'required',
                'date',
            ],

            'worker_id' => [
                'required',
                'exists:workers,id',
            ],

            'project_id' => [
                'nullable',
                'exists:projects,id',
            ],

            'activity' => [
                'required',
                'string',
                'max:255',
            ],

            'start_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'end_time' => [
                'nullable',
                'date_format:H:i',
                'after_or_equal:start_time',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

        ]);


        $validated['status'] = 'pending';

        $validated['created_by'] = auth()->id();


        DailySchedule::create($validated);


        return redirect()
            ->route(
                'daily-schedules.index',
                [
                    'date' => $validated['date']
                ]
            )
            ->with(
                'success',
                'Actividad programada correctamente.'
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
public function edit(DailySchedule $dailySchedule)
{
    $workers = Worker::orderBy('name')->get();

    $projects = Project::orderBy('name')->get();

    return view(
        'daily-schedules.edit',
        compact(
            'dailySchedule',
            'workers',
            'projects'
        )
    );
}

    /**
     * Update the specified resource in storage.
     */
public function update(
    Request $request,
    DailySchedule $dailySchedule
) {
    $validated = $request->validate([

        'date' => [
            'required',
            'date',
        ],

        'worker_id' => [
            'required',
            'exists:workers,id',
        ],

        'project_id' => [
            'nullable',
            'exists:projects,id',
        ],

        'activity' => [
            'required',
            'string',
            'max:255',
        ],

        'start_time' => [
            'nullable',
            'date_format:H:i',
        ],

        'end_time' => [
            'nullable',
            'date_format:H:i',
            'after_or_equal:start_time',
        ],

        'status' => [
            'required',
            'in:pending,in_progress,completed',
        ],

        'notes' => [
            'nullable',
            'string',
        ],

    ]);


    $dailySchedule->update($validated);


    return redirect()
        ->route(
            'daily-schedules.index',
            [
                'date' => $validated['date']
            ]
        )
        ->with(
            'success',
            'Actividad actualizada correctamente.'
        );
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(DailySchedule $dailySchedule)
{
    $date = $dailySchedule->date->format('Y-m-d');

    $dailySchedule->delete();

    return redirect()
        ->route(
            'daily-schedules.index',
            [
                'date' => $date
            ]
        )
        ->with(
            'success',
            'Actividad eliminada correctamente.'
        );
}

public function complete(DailySchedule $dailySchedule)
{
    abort_unless(
        auth()->check() &&
        in_array(
            auth()->user()->role,
            ['admin', 'management', 'supervisor']
        ),
        403
    );


    $dailySchedule->update([
        'status' => 'completed',
    ]);


    return redirect()
        ->route('daily-schedules.index', [
            'date' => $dailySchedule->date->format('Y-m-d')
        ])
        ->with(
            'success',
            'Actividad marcada como terminada.'
        );
}


}
