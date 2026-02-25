<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_types')->insert([
            ['name' => 'metre_box'],
            ['name' => 'adapter_box'],
        ]);
    }
}
