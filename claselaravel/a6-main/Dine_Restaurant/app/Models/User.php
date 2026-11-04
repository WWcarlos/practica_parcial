<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'table_id',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function attendedTables()
    {
        return $this->hasMany(Table::class, 'waiter_id');
    }

    // Helper para verificar rol
    public function hasRole(string $roleName): bool
    {
        return $this->role && strtolower($this->role->name) === strtolower($roleName);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('Administrator');
    }

    public function isWaiter(): bool
    {
        return $this->hasRole('Waiter');
    }

    public function isChef(): bool
    {
        return $this->hasRole('Chef');
    }

    public function isCustomer(): bool
    {
        return $this->hasRole('Customer');
    }
}
