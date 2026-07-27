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
        Schema::table('materials', function (Blueprint $table) {

            $table->decimal('warning_stock',10,2)
                ->default(25)
                ->after('initial_quantity');

            $table->decimal('critical_stock',10,2)
                ->default(10)
                ->after('warning_stock');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            //
        });
    }
};
