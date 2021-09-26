<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $table = 'couriers';
    protected $fillable = [
    	'transaction_id',
    	'courier',
    	'package',
    	'price',
    	'destination',
    	'confirm'
    ];

    public function Transactions()
    {
    	return $this->belongsTo(Transaction::class, 'id');
    }

    public function CourierDestinations()
    {
    	return $this->hasOne(CourierDestination::class, 'courier_id');
    }
}
