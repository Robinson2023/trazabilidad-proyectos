<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'budget',
        'client',
        'status',
        'estimated_hours',
        'start_date',
        'end_date'
    ];

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function workers()
    {
        return $this->belongsToMany(Worker::class)
            ->withPivot('hours')
            ->withTimestamps();
    }

    public function laborEntries()
    {
        return $this->hasMany(LaborEntry::class);
    }
}