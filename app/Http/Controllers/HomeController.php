<?php

namespace App\Http\Controllers;

use Cart;
use Session;
use Sentinel;
use Response;
use App\Slide;
use App\Banner;
use App\Contact;
use App\Product;
use App\Baccount;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::content();
        $cart_count = Cart::count();
        $cart_total = Cart::subtotal();
        $check = Sentinel::check();
        $slide = Slide::all();
        $banner = Banner::all();
        $contact = Contact::all()->first();
        $baccount= Baccount::all(); 
        $active = 'home';
        if($check){
            $user = Sentinel::getUser();
            $name = $user->first_name.' '.$user->last_name;
            return view('home.index', compact('name', 'slide', 'banner', 'active','cart', 'cart_count', 'cart_total', 'contact', 'baccount'));
        }else{
            return view('home.index', compact('active', 'slide', 'banner', 'cart', 'cart_count', 'cart_total', 'contact', 'baccount'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $product = Product::with('Images')->where('available', 1)->orderby('id', 'desc')->paginate(8);
        return response()->json(
            view('home.content_product', [ 'results' => $product ])->render()
        );
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
        return redirect()->route('product_detail', $request->product_id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_home(Request $request)
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
        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_cart()
    {
        $cart = Cart::content();
        $cart_count = Cart::count();
        $cart_total = Cart::subtotal();
        // dd($cart);
        return response()->json(
            view('home.cart_product', [ 'results' => $cart, 'results_count' => $cart_count, 'results_total' => $cart_total ])->render()
        );
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
