<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'available', 'category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_dishes');
    }
}
