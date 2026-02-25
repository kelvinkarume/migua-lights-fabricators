<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_size_id',
         'quantity_picked',
        'quantity_sold',
        'price_per_size',
        'total_amount',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }
}
