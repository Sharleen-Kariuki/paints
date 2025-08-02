<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail,CanResetPassword
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function roles()
{
    return $this->belongsToMany(Role::class);
}

public function hasRole($role)
{
    return $this->roles()->where('name', $role)->exists();
}

public function hasPermission($permission)
{
    return $this->roles()->whereHas('permissions', function($q) use ($permission) {
        $q->where('name', $permission);
    })->exists();
}

}
