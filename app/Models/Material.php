<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'code',
        'name',
        'unit',
        'base_cost'
    ];

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($material) {

        $last = Material::orderBy('id', 'desc')->first();

        $nextNumber = $last ? $last->id + 1 : 1;

        $material->code = 'MAT-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    });
}
}
