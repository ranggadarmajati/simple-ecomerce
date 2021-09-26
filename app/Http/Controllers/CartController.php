<?php

namespace App\Http\Controllers;

use Cart;
use Sentinel;
use App\Contact;
use App\Baccount;
use Illuminate\Http\Request;
use App\Http\Requests\Product\ProductRequest;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati < WA: 085721731478 | EMAIL: rangga.android69@gmail.com >
     */
    public function index()
    {
        $cart = Cart::content();
        $cart_count = Cart::count();
        $cart_total = Cart::subtotal();
        $check = Sentinel::check();
        $total_weight = Cart::total_weight();
        $contact = Contact::all()->first();
        $baccount = Baccount::all();
        $active = 'cart';
        if($check){
            $user = Sentinel::getUser();
            $name = $user->first_name.' '.$user->last_name;
            return view('cart.index', compact('name', 'active','cart', 'cart_count', 'cart_total', 'total_weight','contact', 'baccount'));
        }else{
            return view('cart.index', compact('active', 'cart', 'cart_count', 'cart_total', 'total_weight','contact', 'baccount'));
        }
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
     * @author Rangga Darmajati < WA: 085721731478 | EMAIL: rangga.android69@gmail.com >
     */
    public function add_chart_product_detail(ProductRequest $request)
    {
        $chart = [ 
            'id' => $request->product_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => $request->weight ? $request->weight : null,
            'options' => [
                'size' => isset($request->size) ? $request->size : null, 
                'color' => isset($request->color) ? $request->color : null, 
                'image' => $request->image,
            ],
        ];
        
        Cart::add($chart);
        \Session::flash('success_add_cart', 'Item Berhasil ditambahkan!');
        return redirect()->route('product_detail', $request->product_id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati < WA: 085721731478 | EMAIL: rangga.android69@gmail.com >
     */
    public function store_home(Request $request)
    {
        $chart = [ 
            'id' => $request->product_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => $request->weight ? $request->weight : null,
            'options' => [
                'size' => isset($request->size) ? $request->size : null, 
                'color' => isset($request->color) ? $request->color : null, 
                'image' => $request->image,
            ],
        ];
        
        Cart::add($chart);
        \Session::flash('success_add_cart', 'Item Berhasil ditambahkan!');
        return redirect()->route('home');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati < WA: 085721731478 | EMAIL: rangga.android69@gmail.com >
     */
    public function add_cart_product(Request $request)
    {
        $chart = [ 
            'id' => $request->product_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => $request->weight ? $request->weight : null,
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
        //
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
     * @author Rangga Darmajati < WA: 085721731478 | EMAIL: rangga.android69@gmail.com >
     */
    public function update(Request $request)
    {
        if($request->get('product_id') && $request->get('increment') == 1 ){
            $get = Cart::get($request->get('product_id'));
            Cart::update($request->get('product_id'), $get->qty + 1);
        }

        if($request->get('product_id') && $request->get('decrease') == 1 ){
            $get = Cart::get($request->get('product_id'));
            Cart::update($request->get('product_id'), $get->qty - 1);
        }

        $cart = Cart::Content();

        \Session::flash('success_update_cart', 'Qty Berhasil update!');
        return redirect()->route('cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati < WA: 085721731478 | EMAIL: rangga.android69@gmail.com > 
     */
    public function destroy($id)
    {
        Cart::remove($id);
        \Session::flash('success_remove_cart', 'Qty Berhasil dihapus!');
        return redirect()->route('cart');  
    }
}
