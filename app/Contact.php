<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $fillable = [
    	'longitude',
    	'latitude',
    	'address',
    	'hp_no',
    	'telp_no',
    	'wa_no',
    	'bbm_pin',
    	'line_id',
    	'facebook_src',
    	'instagram_src',
    	'youtube_src',
    	'rekening_no'
    ];
   protected $appends = ['srcw'];

   /**
	* This for SRC web.whatsapp.com
	* @author rangga.darmajati (rangga.android69@gmail.com)
   	*/

   public function getSrcwAttribute()
   {
   		if($this->wa_no){
   			$whatsapp = $this->wa_no;
   			$hide_0   = substr($whatsapp, 1);
   			return 'https://web.whatsapp.com/send?phone=+62'.$hide_0;
   		}
   }
}
