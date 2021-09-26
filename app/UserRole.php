<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserRole extends Model
{
    protected $table = 'role_users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'role_id'];

    
    // This for relation to table Users

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
