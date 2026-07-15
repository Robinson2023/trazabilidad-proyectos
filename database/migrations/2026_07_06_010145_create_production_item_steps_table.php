<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_item_steps', function (Blueprint $table) {

            $table->id();

            $table->foreignId('production_item_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('product_step_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->enum('status', [
                'pending',
                'completed'
            ])->default('pending');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_item_steps');
    }
};
