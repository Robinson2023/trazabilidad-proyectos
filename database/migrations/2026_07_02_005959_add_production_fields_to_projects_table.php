<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->integer('production_quantity')
                  ->default(1)
                  ->after('other_description');

            $table->string('product_image')
                  ->nullable()
                  ->after('production_quantity');

        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->dropColumn([
                'production_quantity',
                'product_image'
            ]);

        });
    }
};