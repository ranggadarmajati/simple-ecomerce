<?php

namespace App;

use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'desc', 'price', 'category', 'available', 'weight'];
    protected $appends = ['available_desc', 'category_desc'];

    # this for relation belongs to table categories
    # author rangga darmajati <WA: 085721731478>
    public function Categories()
    {
    	return $this->belongsTo(Category::class, 'category');
    }

    # this for relation has many on table images
    # author rangga darmajati <WA: 085721731478>
    public function Images()
    {
    	return $this->hasMany(Image::class, 'product_id');
    }

    # this for relation has many on table color
    # author rangga darmajati <WA: 085721731478>
    public function Colors()
    {
        return $this->hasMany(Color::class, 'product_id');
    }

    # this for relation has many on table sizes
    # author rangga darmajati <WA: 085721731478>
    public function Sizes()
    {
        return $this->hasMany(Size::class, 'product_id');
    }

    public function getAvailableDescAttribute()
    {
    	if($this->available){
    		return 'Tersedia';
    	}else{
    		return 'Tidak Tersedia';
    	}
    }

    public function getCategoryDescAttribute()
    {
        $category = \App\Category::where('id', $this->category)->first();
        return ucwords($category->name);
    }

    # this for get list product data
    # parameter $request, $query
    # author rangga darmajati <WA: 085721731478>
    public function scopeGetLists($query, Request $request)
    {
        $sort = $request->input('sort') ? explode('|', $request->input('sort') ) : ['id', 'desc'];
        $product = $query
                   ->from('products')
                   ->where( function( $product ) use( $request, $query ){

                        /**
                         * This fucntion for search By search
                         * @param $request->search
                         * @return json
                         */
                        if( $request->has('search') ){
                            $lowerSearch = '%'.strtolower($request->input('search')).'%';
                            $product->where(\DB::raw('lower(name)'), 'like', $lowerSearch);
                        }

                        /**
                         * This fucntion for search By category
                         * @param $request->category
                         * @return json
                         */
                        if( $request->has('category') ){
                            $category = $request->input('category');
                            $product->where(\DB::raw('category'), $category);
                        }

                        /**
                         * This fucntion for search By price
                         * @param $request->price
                         * @return json
                         */
                        if( $request->has('price') ){
                            $price = $request->input('price');
                            if ($price != 'all'){
                                
                            list($price_start, $price_end)  = explode("-", $price);
                            $product->whereBetween('price', array($price_start, $price_end));
                            }
                            else{

                            $product->where(\DB::raw('price'), '>','0');
                            }
                        }

                   })->where('available', 1)->orderby($sort[0], $sort[1]);

                    \Log::info("===========================START-QUERY-PRODUCT==================================");
                    \Log::info($product->toSql());
                    \Log::info($product->getBindings());
                    \Log::info("===========================END-QUERY-PRODUCT====================================");

        return $product;   
    }
}
