<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDish extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
