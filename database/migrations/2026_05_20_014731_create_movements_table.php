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
    Schema::create('movements', function (Blueprint $table) {
        $table->id();

        // Tipo de movimiento
        $table->enum('type', ['in', 'out', 'return', 'adjust']);

        // Material relacionado
        $table->foreignId('material_id')
            ->constrained('materials')
            ->cascadeOnDelete();

        // Proyecto (puede ser null en entradas de inventario)
        $table->foreignId('project_id')
            ->nullable()
            ->constrained('projects')
            ->nullOnDelete();

        // Usuario que registra el movimiento
        $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        // Cantidad movida
        $table->decimal('quantity', 12, 2);

        // Código escaneado (barcode)
        $table->string('barcode_scanned')->nullable();

        // Observaciones
        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
