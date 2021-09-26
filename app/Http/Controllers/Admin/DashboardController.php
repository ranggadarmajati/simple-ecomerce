<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Product;
use App\Transaction;
use App\OrderConfirm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$getCountTransaction = Transaction::with('OrderConfirms')->orderby('id', 'desc')->count();
    	$getCountProduct = Product::count();
    	$getCountUser = \App\User::count();
    	$chartData = DB::table('trans_peryear_view')->get();
        $menu = 'dashboard';

    	// return response()->json(['chartData' => $chartData], 200);


        return view('admin.dashboard.index', compact('menu', 'getCountTransaction', 'getCountProduct', 'getCountUser'));
    }

    /**
     * Display a listing of the resource TransactionChart.
     *
     * @return \Illuminate\Http\Response
     */
    public function TransactionChart(Request $request)
    {
    	$year = $request->input('year') ? $request->input('year') : date('Y'); 
    	$chartData = DB::table('trans_peryear_view')
    				->where('year', $year)
    				->get();

    	return response()->json(['chartData' => $chartData], 200);
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
