<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    public function run()
    {
        $types = ['metrebox', 'adapterbox'];
        foreach ($types as $type) {
            ProductType::firstOrCreate(['name' => $type]);
        }
    }
}