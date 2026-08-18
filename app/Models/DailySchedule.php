<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Worker;
use App\Models\Project;
use App\Models\User;

class DailySchedule extends Model
{
    protected $fillable = [

        'date',
        'worker_id',
        'project_id',
        'activity',
        'start_time',
        'end_time',
        'status',
        'notes',
        'created_by',

    ];


    protected $casts = [

        'date' => 'date',

    ];


    // Trabajador asignado
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }


    // Proyecto
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    // Usuario que creó la programación
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}