<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade'); // production manager

            $table->foreignId('product_type_id')
                  ->constrained('product_types');

            $table->foreignId('product_size_id')
                  ->constrained('product_sizes');

            $table->integer('quantity');

            $table->date('production_date');
            $table->integer('month');
            $table->integer('year');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
