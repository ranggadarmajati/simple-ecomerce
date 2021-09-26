<?php

namespace App\Http\Controllers;

use Cart;
use Sentinel;
use Response;
use App\Product;
use App\Contact;
use App\Category;
use App\Baccount;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = Cart::content();
        $cart_count = Cart::count();
        $cart_total = Cart::subtotal();
        $category = Category::all();
        $contact = Contact::all()->first();
        $baccount = Baccount::all();
        $check = Sentinel::check();
        $active = 'product';

        if($check){

            $user = Sentinel::getUser();
            $name = $user->first_name.' '.$user->last_name;       
            
            return view('product.index', compact('name', 'active', 'category', 'cart', 'cart_count', 'cart_total', 'contact', 'baccount'));

        }else{
            
            return view('product.index', compact('product', 'active', 'category', 'cart', 'cart_count', 'cart_total', 'contact', 'baccount'));;
        }
    }

    public function getDataProduk(Request $request)
    {
        $limit = $request->input('limit') ? : 8;
        $product = Product::with('Images')->getLists($request)->paginate($limit);
        
        return response()->json(['success' => true, 'contents' => $product], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_cart_product(Request $request)
    {
        $chart = [ 
            'id' => $request->product_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'options' => [
                'size' => isset($request->size) ? $request->size : null, 
                'color' => isset($request->color) ? $request->color : null, 
                'image' => $request->image 
            ],
        ];
        
        Cart::add($chart);
        \Session::flash('success_add_cart', 'Item Berhasil ditambahkan!');
        return redirect()->route('product');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::content();
        $cart_count = Cart::count();
        $cart_total = Cart::subtotal();
        $contact = Contact::all()->first();
        $baccount = Baccount::all();
        $product = Product::with('Colors','Images', 'Sizes', 'Categories')->find($id);
        $active = 'product';
        $results = $this->related_product($product->category);
        $check = Sentinel::check();
        if($check){

            $user = Sentinel::getUser();
            $name = $user->first_name.' '.$user->last_name;       
            return view('product.product_detail', compact('product', 'active', 'results', 'name', 'cart','cart_total','cart_count', 'contact', 'baccount'));

        }else{
            
            return view('product.product_detail', compact('product', 'active', 'results', 'cart', 'cart_total', 'cart_count', 'contact', 'baccount'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function related_product($category)
    {
        $product = Product::with('Images')->where('category', $category)->where('available', 1)->orderby('id', 'desc')->get();
        
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
