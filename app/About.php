<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';
    protected $fillable = ['image_about', 'content'];
    protected $appends	= ['src'];

    public function getSrcAttribute()
    {
    	if($this->image_about){
    		$images = $this->image_about;
    		return url('fashe-colorlib/images/about/'.$images);
    	}
    }
}
