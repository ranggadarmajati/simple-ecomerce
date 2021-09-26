<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderConfirm extends Model
{
    protected $table = 'order_confirms';
    protected $fillable = [
    	'transaction_id',
    	'proof_of_payment',
    	'admin_confrim',
        'total_to_be_paid',
        'rek_number',
        'rek_name',
        'transfer_date'
    ];

    public function Transactions()
    {
    	return $this->belongsTo(Transaction::class, 'id');
    }
}
