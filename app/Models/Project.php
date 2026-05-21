<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'client',
        'status',
        'start_date',
        'end_date',
        'estimated_hours'
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
}