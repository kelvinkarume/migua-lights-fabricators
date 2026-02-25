<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_type_id',
        'product_size_id',
        'quantity',
        'production_date',
        'month',
        'year',
    ];

    /* ==============================
        RELATIONSHIPS
    ============================== */

    // Production belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Production belongs to a product type
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    // Production belongs to a product size
    public function productSize()
    {
        return $this->belongsTo(ProductSize::class);
    }
}
