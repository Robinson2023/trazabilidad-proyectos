<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ['name', 'role', 'hour_rate'];

    public function projects()
    {
        return $this->belongsToMany(Project::class)
            ->withPivot('hours')
            ->withTimestamps();
    }

    public function laborEntries()
    {
        return $this->hasMany(LaborEntry::class);
    }
}
