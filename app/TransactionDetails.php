<?php

namespace App;

use App\Product;
use App\Image;
use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    protected $table = 'transaction_details';
    protected $fillable = [
    	'transaction_id',
    	'product_id',
    	'qty',
    	'price',
    	'size',
    	'color',
    	'total'
    ];
    protected $appends = ['imagesrc', 'productname'];

    # this for relation belongs to table transactions
    # author rangga darmajati <WA: 085721731478>
    public function Transactions()
    {
    	return $this->belongsTo(Transaction::class, 'id');
    }

    public function getImagesrcAttribute()
    {
        $product_id = $this->product_id;
        $image = Image::where('product_id',$product_id)->first();
        return $image['src'];
    }

    public function getProductnameAttribute()
    {
        $product_id = $this->product_id;
        $product = Product::find($product_id);
        return $product->name;
    }
}
