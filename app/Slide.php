<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slide';
    protected $fillable = ['image_slide', 'title', 'description'];
    protected $appends = ['src'];

    public function getSrcAttribute()
    {
    	if($this->image_slide){
    		$images = $this->image_slide;
    		return url('fashe-colorlib/images/slide/'.$images);
    	}
    }
}
