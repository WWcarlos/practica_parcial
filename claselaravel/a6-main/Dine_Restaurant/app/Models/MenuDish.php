<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuDish extends Model
{
    use HasFactory;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }
}
