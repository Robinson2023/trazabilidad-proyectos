<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\GasSetting;

class GasCylinder extends Model
{
    protected $fillable = [

    'number',

    'gas_type',

    'start_date',

    'initial_lbs',

    'current_lbs',

    'equipment_id',

    'worker_id',

    'notes',

    'cylinder_cost',

    'cost_per_lb',

];

public function equipment()
{
    return $this->belongsTo(GasEquipment::class,'equipment_id');
}

public function worker()
{
    return $this->belongsTo(Worker::class);
}//

public function getStatusAttribute()
{
    $setting = GasSetting::first();

    if (!$setting) {
        return [
            'color' => 'green',
            'text' => 'Disponible'
        ];
    }

    if ($this->current_lbs <= $setting->red_limit) {

        return [
            'color' => 'red',
            'text' => 'Cambiar inmediatamente'
        ];

    }

    if ($this->current_lbs <= $setting->yellow_limit) {

        return [
            'color' => 'yellow',
            'text' => 'Solicitar cilindro'
        ];

    }

    return [
        'color' => 'green',
        'text' => 'Disponible'
    ];
}

public function consumptions()
{
    return $this->hasMany(GasCylinderConsumption::class);
}

}
