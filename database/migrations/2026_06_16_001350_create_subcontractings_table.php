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
    Schema::create('subcontractings', function (Blueprint $table) {

        $table->id();

        $table->foreignId('project_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('supplier');

        $table->string('service');

        $table->text('description')->nullable();

        $table->decimal('amount', 15, 2);

        $table->date('service_date');

        $table->enum('status', [
            'pending',
            'paid'
        ])->default('pending');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcontractings');
    }
};
