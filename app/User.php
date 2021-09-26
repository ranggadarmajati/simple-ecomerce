<?php

namespace App;

use App\UserRole;
use App\Transaction;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $appends = ['fullname'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * This function for Eloquent relation table 
     */
    public function roleUsers()
    {
        return $this->hasOne(UserRole::class, 'user_id');
    }

    Public function getFullnameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function Transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }
}
