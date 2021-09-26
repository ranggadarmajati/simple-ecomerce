<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    #this for relation has many on table product
    #author rangga darmajati <WA: 085721731478>
    public function product()
    {
    	return $this->hasMany(Product::class, 'category');
    }
}
