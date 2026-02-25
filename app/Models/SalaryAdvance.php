<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryAdvance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'advance_date',
        'amount',
        'month',
        'status',
    ];

      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
