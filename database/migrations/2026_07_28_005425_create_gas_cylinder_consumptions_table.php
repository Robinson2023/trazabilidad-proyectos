<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gas_cylinder_consumptions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('gas_cylinder_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('project_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('equipment_id')
                  ->constrained('gas_equipments')
                  ->cascadeOnDelete();

            $table->foreignId('worker_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->decimal('start_lbs',10,2);

            $table->decimal('end_lbs',10,2);

            $table->decimal('consumed_lbs',10,2);

            $table->decimal('cost_per_lb',12,2);

            $table->decimal('total_cost',12,2);

            $table->text('notes')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gas_cylinder_consumptions');
    }
};