<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
    	'order_no',
    	'user_id',
    	'order_total',
        'transaction_date',
        'expired_transaction_date'
    ];

    #this for relation has many on table transaction_details
    #author rangga darmajati <WA: 085721731478>
    public function TransactionDetails()
    {
    	return $this->hasMany(TransactionDetails::class, 'transaction_id');
    }

    #this for relation has one on table couriers
    #author rangga darmajati <WA: 085721731478>
    public function Couriers()
    {
    	return $this->hasOne(Courier::class, 'transaction_id');
    }

    #this for relation has one on table order_confirms
    #author rangga darmajati <WA: 085721731478>
    public function OrderConfirms()
    {
    	return $this->hasOne(OrderConfirm::class, 'transaction_id');
    }

    #this for relation Belongs to on table user
    #author rangga darmajati <WA: 085721731478>
    public function Users()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
