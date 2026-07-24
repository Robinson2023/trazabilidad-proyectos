<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductionItemStep;

class ProductionSynchronizationService
{
    public function sync(Product $product)
    {
        $created = 0;

        $product->load([
            'steps',
            'productionItems.steps'
        ]);

        foreach ($product->productionItems as $item) {

            foreach ($product->steps as $step) {

                $exists = ProductionItemStep::where(
                    'production_item_id',
                    $item->id
                )
                ->where(
                    'product_step_id',
                    $step->id
                )
                ->exists();

                if (!$exists) {

                    ProductionItemStep::create([

                        'production_item_id' => $item->id,

                        'product_step_id' => $step->id,

                        'status' => 'pending'

                    ]);

                    $created++;

                }

            }

        }

        return $created;
    }
}