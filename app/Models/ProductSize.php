<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $fillable = [
        'product_type_id',
        'size',
    ];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
}
