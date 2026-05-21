<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = [
        'type',
        'material_id',
        'project_id',
        'user_id',
        'quantity',
        'barcode_scanned',
        'notes'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}