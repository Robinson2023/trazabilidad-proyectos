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

            $material = Material::findOrFail($data['material_id']);

            $inventory = Inventory::firstOrCreate(
                ['material_id' => $material->id],
                ['quantity' => 0]
            );

            // Crear movimiento
            $movement = Movement::create($data);

            // Lógica de inventario
  switch ($data['type']) {

    case 'in':
        $inventory->quantity += $data['quantity'];
        break;

    case 'out':
        $inventory->quantity -= $data['quantity'];
        break;

    case 'return':
        $inventory->quantity += $data['quantity'];
        break;

    case 'adjust':
        $inventory->quantity = $data['quantity'];
        break;

    default:
        throw new \Exception("Tipo de movimiento inválido");
}

            $inventory->save();

            return $movement;
        });
    }
}