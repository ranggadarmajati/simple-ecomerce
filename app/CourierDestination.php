<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourierDestination extends Model
{
    protected $table = 'courier_destinations';
    protected $fillable = [
    	'courier_id',
    	'province',
    	'county_town',
    	'district',
    	'post_code',
    	'address',
        'hp_no'
    ];

    public function Couries()
    {
    	return $this->belongsTo(Courier::class, 'id');
    }
}
