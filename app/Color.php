<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = ['product_id', 'color'];
    protected $hidden = ['color', 'created_at', 'updated_at'];
    protected $appends = [ 'name' ];

    # this for relation belongs to table Products
    # author rangga darmajati <WA: 085721731478>
    public function Products()
    {
    	return $this->belongsTo(Product::class, 'id');
    }

    public function getNameAttribute()
    {
    	if($this->color){
    		$colors = ucwords($this->color);
    		return $colors;
    	}
    }
}
