<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'material_id',
        'quantity'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}