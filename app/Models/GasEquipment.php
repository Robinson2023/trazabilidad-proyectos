<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GasEquipment extends Model
{
    protected $table = 'gas_equipments';

    protected $fillable = [

        'code',
        'name',
        'brand',
        'model',
        'active',

    ];

    public function cylinders()
    {
        return $this->hasMany(GasCylinder::class, 'equipment_id');
    }
}