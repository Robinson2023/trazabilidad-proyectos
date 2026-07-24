<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Worker;

class GasEquipment extends Model
{
    protected $table = 'gas_equipments';

    protected $fillable = [

        'code',
        'name',
        'brand',
        'model',
        'worker_id',
        'active',

    ];

    public function cylinders()
    {
        return $this->hasMany(GasCylinder::class, 'equipment_id');
    }

    public function worker()
{
    return $this->belongsTo(Worker::class);
}

}