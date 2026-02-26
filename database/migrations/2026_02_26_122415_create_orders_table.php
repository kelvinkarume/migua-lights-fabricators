<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
    $table->id();

    // Customer info
    $table->string('customer_name')->nullable();
    $table->string('phone_number')->nullable();
    $table->string('id_number')->nullable();
    $table->string('area_of_residence')->nullable();

    // Order info
    $table->json('products'); 
    $table->decimal('total_price', 10, 2);
    $table->enum('status', ['pending', 'delivered'])->default('pending');

    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}