<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaborEntry extends Model
{
    protected $fillable = [
        'worker_id',
        'project_id',
        'work_date',
        'hours',
        'notes'
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}