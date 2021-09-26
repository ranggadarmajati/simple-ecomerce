<?php

namespace App\Http\Controllers;

use DB;
use Cart;
use Sentinel;
use App\Courier;
use App\Contact;
use App\Baccount;
use App\Transaction;
use App\OrderConfirm;
use App\CourierDestination;
use App\TransactionDetails;
use Illuminate\Http\Request;
use App\Events\Customer\OrderNew;
use App\Http\Requests\BuktiTransferRequest;
use App\Events\Customer\PaymentConfirmation;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Sentinel::check();
        $cart = Cart::content();
        $cart_total = Cart::subtotal();
        $contact = Contact::all()->first();
        $cart_count = Cart::count();
        $contact = Contact::all()->first();
        $baccount = Baccount::all();
        $active = '';
        $type = 'order';

        if($check){

            $user = Sentinel::getUser();
            $order_view = DB::table('order_confirm_view')
                        ->where('user_id', $user->id)
                        // ->whereNull('proof_of_payment')
                        ->get();
                        
            $name = $user->first_name.' '.$user->last_name; 

            return view('order.index', compact('type','order_view', 'cart_count', 'name', 'active','contact', 'baccount', 'cart', 'cart_total'));
        }else{

            return view('order.index', compact('type','order_view', 'cart_count', 'active','contact', 'baccount', 'cart', 'cart_total'));
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
     */
    public function store(Request $request)
    {
        
        $user = Sentinel::getUser();
        $user_id = $user->id;
        $order_no = generateNoOrder();
        $rand_int = mt_rand(10,100);
        $current_date = date('Y-m-d');
        $transaction = Transaction::create([
            'order_no' => $order_no,
            'user_id' => $user->id,
            'order_total' => $request->order_total,
            'transaction_date' => $current_date,
            'expired_transaction_date' => date('Y-m-d', strtotime($current_date.'+ 2 day'))
        ]);

        if($transaction){
            $courier = Courier::create([
                'transaction_id' => $transaction->id,
                'courier' => $request->courier,
                'package' => $request->package,
                'price' => $request->price,
                'destination' => $request->county_town
            ]);

            $courier_destination = CourierDestination::create([
                'courier_id' => $courier->id,
                'province' => $request->province,
                'county_town' => $request->county_town,
                'district' => $request->district_real,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'hp_no' => $request->hp_no
            ]);

            $order_confirm = OrderConfirm::create([
                'transaction_id' => $transaction->id,
                'total_to_be_paid' => $request->order_total + strval($rand_int)
            ]);


            $cart = Cart::content();

            foreach ($cart as $item) {
                TransactionDetails::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->id,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'size' => $item->options['size'] ? $item->options['size'] : null,
                    'color' => $item->options['color'] ? $item->options['color'] : null,
                    'total' => $item->qty * $item->price
                ]);
            }

            $detail_order = DB::table('order_detail_view')
                        ->where('order_no', $order_no)
                        ->where('user_id', $user_id)
                        ->get(); 

            // This for send mails if Customer Create New Order
            event(new OrderNew($user, $detail_order));

            Cart::destroy();
            \Session::flash('success_order', 'Hore anda berhasil order, segera transfer dan konfirmasi pembayaran anda!');
            return redirect()->route('home');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $check = Sentinel::check();
        $cart = Cart::content();
        $cart_total = Cart::subtotal();
        $cart_count = Cart::count();
        $contact = Contact::all()->first();
        $baccount = Baccount::all();
        $active = '';
        $type = 'detail';

        if($check){

            $user = Sentinel::getUser();
            $order_detail = DB::table('order_detail_view')
                        ->where('user_id', $user->id)
                        ->where('order_no', $id)
                        ->get();
                        
            $name = $user->first_name.' '.$user->last_name; 

            return view('order.index', compact('type','order_detail', 'cart_count', 'name', 'active','contact', 'baccount', 'cart_total', 'cart'));
        }else{

            return view('order.index', compact('type','order_detail', 'cart_count', 'active','contact', 'baccount', 'cart_total', 'cart'));
        }
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
     * get Confirm Payment the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati < WA: 085721731478 | Email: rangga.android69@gmail.com >
     */
    public function getConfirmPayment(Request $request)
    {
        $check = Sentinel::check();
        $cart = Cart::content();
        $cart_total = Cart::subtotal();
        $contact = Contact::all()->first();
        $baccount = Baccount::all();
        $param = 'get_payment';
        if($check){
            $user = Sentinel::getUser();
            $user_id = $user->id;
            $order_number = $request->order_number;
            $name = $user->first_name.' '.$user->last_name;
            $cart_count = Cart::count();
            $active = '';
            $type = 'order_confirm';

            $data_payment = DB::table('order_confirm_view')
                            ->where('user_id', $user_id)
                            ->where('order_no', $order_number)
                            ->first();

            return view('order.form_confirm', compact('type','data_payment', 'cart_count', 'name', 'active','contact', 'baccount', 'cart', 'cart_total', 'param'));

        }else{

            return redirect()->route('home');
        
        }
    }

    /**
     * Store Data Payment
     *
     * @param int transaction_id, string rek_name, string rek_number, string proof_of_paid
     * @return \Illuminate\Http\Response
     * @author Rangga Darmajati < WA: 085721731478 | Email: rangga.android69@gmail.com >
     */
    public function StorePayment(Request $request)
    {
        $user = Sentinel::getUser();
        $user_id = $user->id;
        $username = strtolower($user->first_name).'_'.strtolower($user->last_name);
        $transaction_id = $request->transaction_id;
        $rek_name = $request->rek_name;
        $rek_number = $request->rek_number;
        $transfer_date = date('Y-m-d');
        $data = $request->image;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);

        $data = base64_decode($data);
        $image_name = time().'-'.$username.'-transfer.png';
        $path = public_path().'/fashe-colorlib/images/proof_of_payment/'.$image_name;
        file_put_contents($path, $data);

        $order_confirm = OrderConfirm::where('transaction_id', $transaction_id)->first();
        $order_confirm_update = $order_confirm->update([
            'rek_number' => $rek_number,
            'rek_name' => $rek_name,
            'transfer_date' => $transfer_date,
            'proof_of_payment' => $image_name 
        ]);

        if($order_confirm_update){

            $detail_order = DB::table('order_detail_view')
                        ->where('id', $transaction_id)
                        ->where('user_id', $user_id)
                        ->get();

            // This for send mails if Customer Get Paymenr Confirmation
            event(new PaymentConfirmation($user, $detail_order));

            \Session::flash('success_logout', 'Hore anda berhasil konfirmasi pembayaran, admin akan segera cek data konfirmasi Anda!');
            return redirect()->route('order_confirm');
        }

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

    // public function generateNoOrder()
    // {
    //     $str_random = str_random(10);
    //     $date_for_convert = date("Y-m-d");
    //     $split_date = explode("-", $date_for_convert);
    //     $date_convert = $this->MonthToAlfhabet($split_date[1]);
    //     $year = substr($date_for_convert, 2, -6);
    //     $order_no = $year.$date_convert.$split_date[2].$str_random;

    //     return $order_no;
    // }

    // public function MonthToAlfhabet($value)
    // {
    //     if( $value == '01' ){
    //         $result = 'A';
    //     }elseif( $value == '02' ){
    //         $result = 'B';
    //     }elseif( $value == '03' ){
    //         $result = 'C';
    //     }elseif( $value == '04' ){
    //         $result = 'D';            
    //     }elseif( $value == '05' ){
    //         $result = 'E';            
    //     }elseif( $value == '06' ){
    //         $result = 'F';            
    //     }elseif( $value == '07' ){
    //         $result = 'G';            
    //     }elseif( $value == '08' ){
    //         $result = 'H';            
    //     }elseif( $value == '09' ){
    //         $result = 'I';            
    //     }elseif( $value == '10' ){
    //         $result = 'J';            
    //     }elseif( $value == '11' ){
    //         $result = 'K';            
    //     }else{
    //         $result = 'L';
    //     }

    //     return $result;
    // }
}
