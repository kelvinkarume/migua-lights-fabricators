<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('salary_advances', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending')
                  ->after('month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('salary_advances', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};