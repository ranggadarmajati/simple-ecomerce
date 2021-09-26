<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
	protected $table = 'sizes';
	protected $fillable = ['product_id', 'size'];
	protected $hidden = ['size', 'created_at', 'updated_at'];
    protected $appends = [ 'name' ];

    # this for relation belongs to table Products
    # author rangga darmajati <WA: 085721731478>
    public function Products()
    {
    	return $this->belongsTo(Product::class, 'id');
    }

    public function getNameAttribute()
    {
    	if($this->size){
    		$sizes = strtoupper($this->size);
    		return $sizes;
    	}
    }
}
