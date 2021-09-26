<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [ 'slug', 'name', 'permissions' ];
}
