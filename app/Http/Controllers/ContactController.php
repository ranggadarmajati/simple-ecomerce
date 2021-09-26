<?php

namespace App\Http\Controllers;

use Cart;
use Sentinel;
use Response;
use App\Contact;
use App\Baccount;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contact::all()->first();
        $cart = Cart::content();
        $cart_count = Cart::count();
        $cart_total = Cart::subtotal();
        $contact = Contact::all()->first();
        $baccount = Baccount::all();
        $type = 'view';
        $check = Sentinel::check();
        $active = 'contact';
        $gmap_apikey = env('gmap_apikey');

        if ($check) {

            $user = Sentinel::getUser();
            $name = $user->first_name . ' ' . $user->last_name;

            return view('contact.index', compact('data', 'name', 'active', 'cart', 'cart_count', 'cart_total', 'type', 'contact', 'baccount', 'gmap_apikey'));
        } else {

            return view('contact.index', compact('data', 'active', 'cart', 'cart_count', 'cart_total', 'type', 'contact', 'baccount', 'gmap_apikey'));
        }
    }
}
