<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcontracting extends Model
{
    protected $fillable = [
        'project_id',
        'supplier',
        'service',
        'description',
        'amount',
        'service_date',
        'status'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subcontractings()
{
    return $this->hasMany(Subcontracting::class);
}
}

