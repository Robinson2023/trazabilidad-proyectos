<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GasCylinderConsumption extends Model
{
    protected $fillable = [

        'gas_cylinder_id',

        'project_id',

        'equipment_id',

        'worker_id',

        'start_lbs',

        'end_lbs',

        'consumed_lbs',

        'cost_per_lb',

        'total_cost',

        'notes'

    ];

    public function cylinder()
    {
        return $this->belongsTo(GasCylinder::class, 'gas_cylinder_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function equipment()
    {
        return $this->belongsTo(GasEquipment::class, 'equipment_id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}