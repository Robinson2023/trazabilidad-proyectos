<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionItemStep extends Model
{
    protected $fillable = [

        'production_item_id',
        'product_step_id',
        'status'

    ];

    public function productionItem()
    {
        return $this->belongsTo(ProductionItem::class);
    }

    public function productStep()
    {
        return $this->belongsTo(ProductStep::class);
    }
}