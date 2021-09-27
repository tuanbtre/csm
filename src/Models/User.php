<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'address', 'isadmin', 'username', 'name', 'image', 'email', 'phone', 'password', 'email_verified_at', 'token', 'isactive'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function func()
    {
        return $this->belongsToMany('App\Models\Functions', 'tbl_permission', 'user_id', 'function_id');
    }

    public function hasAccess(string $permissions) : bool
    {
        // check if the permission is available in any permissions
        foreach ($this->func as $func) {
            if($func->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
