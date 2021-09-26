<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table 	= 'banner';
    protected $fillable = ['image_banner'];
    protected $appends	= ['src'];

    public function getSrcAttribute()
    {
    	if($this->image_banner){
    		$images = $this->image_banner;
    		return url('fashe-colorlib/images/banner/'.$images);
    	}
    }
}
