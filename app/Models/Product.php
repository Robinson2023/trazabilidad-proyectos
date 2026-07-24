<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductionItem;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'active'
    ];

    public function steps()
    {
        return $this->hasMany(ProductStep::class)
                    ->orderBy('order');
    }

    public function projects()
{
    return $this->hasMany(Project::class);
}

    public function productionItems()
{
    return $this->hasMany(ProductionItem::class);
}

}

