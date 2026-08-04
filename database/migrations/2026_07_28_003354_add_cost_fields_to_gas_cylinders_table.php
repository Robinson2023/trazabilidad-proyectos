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
            Schema::table('gas_cylinders', function (Blueprint $table) {

                $table->decimal('cylinder_cost',12,2)
                    ->nullable()
                    ->after('current_lbs');

                $table->decimal('cost_per_lb',12,2)
                    ->nullable()
                    ->after('cylinder_cost');

            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gas_cylinders', function (Blueprint $table) {
            //
        });
    }
};
