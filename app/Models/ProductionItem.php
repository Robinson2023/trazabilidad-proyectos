<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionItem extends Model
{
    protected $fillable = [

        'project_id',

        'product_id',

        'code',

        'status',

    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function steps()
{
    return $this->hasMany(ProductionItemStep::class)
                ->with('productStep');
}

public function getProgressAttribute()
{
    $total = $this->steps()->count();

    if ($total == 0) {
        return 0;
    }

    $completed = $this->steps()
        ->where('status', 'completed')
        ->count();

    return round(($completed / $total) * 100);
}

}