<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = ['name'];

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
}
