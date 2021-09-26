<?php

namespace App\Http\Controllers;

use Cart;
use Sentinel;
use Response;
use App\About;
use App\Contact;
use App\Baccount;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::all()->first();
        $cart = Cart::content();
        $cart_count = Cart::count();
        $cart_total = Cart::subtotal();
        $contact = Contact::all()->first();
        $baccount = Baccount::all();
        $check = Sentinel::check();
        $active = 'about';

        if($check){

            $user = Sentinel::getUser();
            $name = $user->first_name.' '.$user->last_name;       
            
            return view('about.index', compact('about', 'name', 'active', 'cart', 'cart_count', 'cart_total','contact', 'baccount'));

        }else{
            
            return view('about.index', compact('about', 'active', 'cart', 'cart_count', 'cart_total','contact', 'baccount'));;
        }
        // return response()->json(['result' => $about->content ]);
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
