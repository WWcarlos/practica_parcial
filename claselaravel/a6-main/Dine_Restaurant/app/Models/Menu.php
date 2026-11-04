<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'start_time', 'end_time', 'active'];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
