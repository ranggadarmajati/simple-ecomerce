<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['product_id','image'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['src'];

    #this for relation belongs to table categories
    #author rangga darmajati <WA: 085721731478>
    public function Products()
    {
    	return $this->belongsTo(Product::class, 'id');
    }

    public function getSrcAttribute()
    {
    	if($this->image){
    		$images = $this->image;
    		return url('fashe-colorlib/images/product/'.$images);
    	}
    }
}
