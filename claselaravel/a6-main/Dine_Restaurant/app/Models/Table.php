<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['number', 'capacity', 'status', 'waiter_id'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function waiter()
    {
        return $this->belongsTo(User::class, 'waiter_id');
    }

    public function customers()
    {
        return $this->hasMany(User::class, 'table_id');
    }
}
