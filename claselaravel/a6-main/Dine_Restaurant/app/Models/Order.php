<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['table_id', 'user_id', 'pay_method_id', 'status', 'total', 'opened_at', 'closed_at'];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payMethod()
    {
        return $this->belongsTo(PayMethod::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
