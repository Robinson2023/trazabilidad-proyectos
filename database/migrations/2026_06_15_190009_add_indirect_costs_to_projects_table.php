<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->decimal('administrative_cost', 12, 2)
                  ->default(0)
                  ->after('budget');

            $table->decimal('transport_cost', 12, 2)
                  ->default(0);

            $table->decimal('food_cost', 12, 2)
                  ->default(0);

            $table->decimal('other_cost', 12, 2)
                  ->default(0);

            $table->string('other_description')
                  ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->dropColumn([
                'administrative_cost',
                'transport_cost',
                'food_cost',
                'other_cost',
                'other_description'
            ]);

        });
    }
};