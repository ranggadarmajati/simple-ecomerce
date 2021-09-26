<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baccount extends Model
{
    protected $table = 'baccount';
    protected $fillable = ['rek_no', 'bank', 'on_behalft', 'bank_logo'];
    protected $appends	= ['src'];

    public function getSrcAttribute()
    {
    	if($this->bank_logo){
    		$images = $this->bank_logo;
    		return url('fashe-colorlib/images/icons/'.$images);
    	}
    }
}
