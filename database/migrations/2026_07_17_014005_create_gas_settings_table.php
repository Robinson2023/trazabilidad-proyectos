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
Schema::create('gas_settings', function (Blueprint $table) {

    $table->id();

    $table->decimal('yellow_limit',8,2)->default(25);

    $table->decimal('red_limit',8,2)->default(10);

    $table->timestamps();

});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gas_settings');
    }
};
