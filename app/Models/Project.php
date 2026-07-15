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
    'end_date',

    'administrative_cost',
    'transport_cost',
    'food_cost',
    'other_cost',
    'other_description',

    // NUEVOS
    'product_id',
    'quantity',
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

    public function subcontractings()
{
    return $this->hasMany(Subcontracting::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}

public function productionItems()
{
    return $this->hasMany(ProductionItem::class);
}
}