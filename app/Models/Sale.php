<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_type_id',
        'sales_date',
        'day',
        'month',
        'year',
        'total_picked',
        'total_sold',
        'total_returned',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
