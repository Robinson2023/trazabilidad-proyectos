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

        $table->string('purchase_unit')->nullable();

        $table->decimal('purchase_quantity',10,2)
              ->nullable();

        $table->decimal('purchase_cost',10,2)
              ->nullable();

    });
}

public function down(): void
{
    Schema::table('materials', function (Blueprint $table) {

        $table->dropColumn([
            'purchase_unit',
            'purchase_quantity',
            'purchase_cost'
        ]);

    });
}
};
