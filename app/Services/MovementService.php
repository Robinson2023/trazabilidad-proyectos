<?php

namespace App\Services;

use App\Models\Movement;
use App\Models\Inventory;
use App\Models\Material;
use Illuminate\Support\Facades\DB;

class MovementService
{
    public function register(array $data)
    {
        return DB::transaction(function () use ($data) {

            return Movement::create($data);
        });
    }
}