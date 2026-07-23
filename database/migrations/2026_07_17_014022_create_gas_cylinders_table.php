<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
{
    Schema::create('gas_cylinders', function (Blueprint $table) {

        $table->id();

        $table->string('number');

        $table->enum('gas_type',[
            'Argón',
            'Agamix',
            'Oxígeno',
            'Acetileno'
        ]);

        $table->date('start_date');

        $table->decimal('initial_lbs',8,2);

        $table->decimal('current_lbs',8,2);

        $table->foreignId('equipment_id')
              ->constrained('gas_equipments');

        $table->foreignId('worker_id')
              ->constrained();

        $table->text('notes')->nullable();

        $table->timestamps();

    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gas_cylinders');
    }
};
