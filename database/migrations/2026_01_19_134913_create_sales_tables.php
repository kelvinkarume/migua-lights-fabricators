<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTables extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_type_id')->constrained('product_types');
            $table->date('sales_date');
            $table->string('day');
            $table->integer('month');
            $table->integer('year');
            $table->integer('total_picked');
            $table->integer('total_sold');
            $table->integer('total_returned');
            $table->timestamps();
        });

        Schema::create('sale_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');
            $table->foreignId('product_size_id')->constrained('product_sizes');
            $table->integer('quantity_sold');
            $table->decimal('price_per_size', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_details');
        Schema::dropIfExists('sales');
    }
}
