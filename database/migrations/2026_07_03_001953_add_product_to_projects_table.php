<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->foreignId('product_id')
                  ->nullable()
                  ->after('client')
                  ->constrained()
                  ->nullOnDelete();

            $table->integer('quantity')
                  ->default(1)
                  ->after('product_id');

        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            $table->dropForeign(['product_id']);

            $table->dropColumn([
                'product_id',
                'quantity'
            ]);

        });
    }
};