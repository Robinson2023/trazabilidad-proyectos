<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gas_cylinders', function (Blueprint $table) {

            $table->enum('lifecycle_status', [
                'available',
                'in_use',
                'pending_return',
                'delivered'
            ])
            ->default('available')
            ->after('cost_per_lb');

        });

        // Los cilindros que ya existen y están
        // asignados a equipo se consideran actualmente en uso.
        DB::table('gas_cylinders')
            ->whereNotNull('equipment_id')
            ->update([
                'lifecycle_status' => 'in_use'
            ]);
    }

    public function down(): void
    {
        Schema::table('gas_cylinders', function (Blueprint $table) {
            $table->dropColumn('lifecycle_status');
        });
    }
};