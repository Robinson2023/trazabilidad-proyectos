<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_schedules', function (Blueprint $table) {

            $table->id();

            // Fecha de la actividad
            $table->date('date');

            // Trabajador asignado
            $table->foreignId('worker_id')
                ->constrained('workers')
                ->cascadeOnDelete();

            // Proyecto relacionado
            $table->foreignId('project_id')
                ->nullable()
                ->constrained('projects')
                ->nullOnDelete();

            // Actividad a realizar
            $table->string('activity');

            // Horario
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            // Estado de la actividad
            $table->enum('status', [
                'pending',
                'in_progress',
                'completed'
            ])->default('pending');

            // Observaciones
            $table->text('notes')->nullable();

            // Usuario que creó la programación
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_schedules');
    }
};