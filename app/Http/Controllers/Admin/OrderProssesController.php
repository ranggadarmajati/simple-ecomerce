<?php

namespace App\Http\Controllers\Admin;

use DB;
use Session;
use App\User;
use App\Courier;
use App\Product;
use Carbon\Carbon;
use App\Transaction;
use App\OrderConfirm;
use App\CourierDestination;
use App\TransactionDetails;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Events\Customer\CourierConfirm;
use App\Events\Customer\OrderConfirmMail;

class OrderProssesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'order_transaction';
        return view('admin.order.index', compact('menu'));
    }

    /**
     * Display a listing of oder datatable.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatableOrder()
    {
        Carbon::setLocale('id');
        $data_order = DB::table('order_confirm_view')->where('admin_confirm', 0)->orderby('transaction_date', 'asc')->get();
   
        return Datatables::of($data_order)
               ->addColumn('action', function($data){
                    return '<center><a href="'.url("admin/view_detail_order").'/'.$data->transaction_id.'" class="btn btn-success" data-original-title="Lihat Order" title="Lihat Order"><i class="fa fa-eye"></i></a> <a href="'.url("admin/view_confirm_order").'/'.$data->transaction_id.'" class="btn btn-warning" data-original-title="Cek & Konfirmasi" title="Cek & Konfirmasi"><i class="fa fa-check"></i></a></center>';
               })
               ->addColumn('aging', function($aging){
                    return '<i>'.Carbon::createFromTimeStamp(strtotime($aging->created_at))->diffForHumans().'</i>';
               })
               ->rawColumns(['action','aging'])
               ->make(true);
    }

    /**
     * Display a listing of oder datatable.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatableOrderConfirm()
    {
        $data_order = DB::table('order_confirm_view')->where('admin_confirm', 1)->orderby('transaction_date', 'asc')->get();
      
        return Datatables::of($data_order)
               ->addColumn('action', function($data){
                    return '<center><a href="'.url("admin/view_detail_order").'/'.$data->transaction_id.'" class="btn btn-success" data-original-title="Lihat Order" title="Lihat Order"><i class="fa fa-eye"></i></a>';
               })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_delivery()
    {
        $menu = 'order_delivery';
        return view('admin.delivery.index', compact('menu'));
    }

    /**
     * Display a listing of oder datatable.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatableConfirmTracking()
    {
        Carbon::setLocale('id');
        $data_order = DB::table('order_confirm_view')->where('admin_confirm', 1)->where('tracking_number', NULL)->orderby('transaction_date', 'asc')->get();
      
        return Datatables::of($data_order)
               ->addColumn('action', function($data){
                    return '<center><a href="'.url("admin/view_confirm_delivery").'/'.$data->transaction_id.'" class="btn btn-success" data-original-title="Lihat Order" title="Input Traking Number"><i class="fa fa-truck"></i></a>';
               })->addColumn('aging', function($aging){
                    return '<i>'.Carbon::createFromTimeStamp(strtotime($aging->created_at))->diffForHumans().'</i>';
               })->rawColumns(['action','aging'])->make(true);
    }

    /**
     * Display a listing of oder datatable.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatableConfirmTrackingDelivery()
    {
        $data_order = DB::table('order_confirm_view')->where('status_send_flag', 1)->orderby('transaction_date', 'asc')->get();
      
        return Datatables::of($data_order)
               ->addColumn('action', function($data){
                    return '<center><a href="'.url("admin/view_detail_order").'/'.$data->transaction_id.'" class="btn btn-success" data-original-title="Lihat Order" title="Lihat Order"><i class="fa fa-eye"></i></a>';
               })->make(true);
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
        $transaction = Transaction::with('OrderConfirms', 'Couriers')->find($id);
        $transaction_detail = TransactionDetails::where('transaction_id', $transaction->id)->get();
        $courier_destination = CourierDestination::where('courier_id', $transaction->couriers['id'])->first();
        $menu = 'order_transaction';
        // return response()->json([$transaction, $courier_destination]);

        return view('admin.order.detail', compact('menu','transaction','transaction_detail', 'courier_destination'));

    }

    /**
     * Display the specified resource confir delivery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_delivery($id)
    {
        $transaction = Transaction::with('OrderConfirms', 'Couriers')->find($id);
        $transaction_detail = TransactionDetails::where('transaction_id', $transaction->id)->get();
        $courier_destination = CourierDestination::where('courier_id', $transaction->couriers['id'])->first();
        $menu = 'order_delivery';
        // return response()->json([$transaction, $courier_destination]);

        return view('admin.delivery.confirm_delivery', compact('menu','transaction','transaction_detail', 'courier_destination'));

    }

    /**
     * Confirm delivery Tracking Number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm_delivery(Request $request)
    {
        $trans_id = $request->transaction_id;
        $tracking_number = $request->tracking_number;
        $couriers = Courier::where('transaction_id', $trans_id);
        $update_couriers = $couriers->update([
            'confrim' => 1,
            'tracking_number' => $tracking_number
        ]); 

        if($update_couriers){

            $user = DB::table('order_confirm_view')
                ->where('transaction_id', $trans_id)
                ->first();

            $detail_order = DB::table('order_detail_view')
                        ->where('id', $trans_id)
                        ->get();
            
            // This for send mails if Admin has been cofirm Tracking Delivery the reques order
            event(new CourierConfirm($user, $detail_order));
            
            \Session::flash('success', 'Konfirmasi Pengiriman Berhasil dan Email Terkirim ke Customer');
            return redirect()->route('admin.transaksi_delivery');
        }else{
            \Session::flash('failled', 'Konfirmasi Pengiriman Gagal dan Email tidak Terkirim ke Customer');
            return redirect()->route('admin.transaksi_delivery');
        }

    }

    /**
     * Print Order_detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print_order_detail($id)
    {
        $transaction = Transaction::with('OrderConfirms', 'Couriers')->find($id);
        $transaction_detail = TransactionDetails::where('transaction_id', $transaction->id)->get();
        $courier_destination = CourierDestination::where('courier_id', $transaction->couriers['id'])->first();
        $menu = 'order_transaction';
        // return response()->json([$transaction, $courier_destination]);

        return view('admin.order.cetak_order_detail', compact('transaction','transaction_detail', 'courier_destination'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_confirm($id)
    {
        $get_data = DB::table('order_confirm_view')->where('transaction_id', $id)->first();
        $menu = 'order_transaction';

        return view('admin.order.confirm', compact('get_data', 'menu'));

    }

    public function confirm_order(Request $request)
    {
        $user_id = $request->user_id;
        $transaction_id = $request->transaction_id;
        $user = DB::table('order_confirm_view')
                ->where('transaction_id', $transaction_id)
                ->where('user_id', $user_id)
                ->first();
        $detail_order = DB::table('order_detail_view')
                        ->where('id', $transaction_id)
                        ->where('user_id', $user_id)
                        ->get(); 
                        // dd($detail_order);
        
        $oder_confirm = OrderConfirm::where('transaction_id', $transaction_id);
        $oder_confirm->update([
            'admin_confirm' => 1
        ]);

        // This for send mails if Admin has been cofirm the reques order
        event(new OrderConfirmMail($user, $detail_order));
        \Session::flash('success', 'Konfirmasi Order Berhasil dan Email Terkirim ke Customer');
        return redirect()->route('admin.transaksi_order');
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
