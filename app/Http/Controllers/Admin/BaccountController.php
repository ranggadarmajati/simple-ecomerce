<?php

namespace App\Http\Controllers\Admin;

use App\Baccount;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class BaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'baccount';
        return view('admin.baccount.index', compact('menu'));
    }

    /**
     * Display a listing Of Baccount.
     *
     * @return Json
     */
    public function DataTableBaccount()
    {
        $baccount = Baccount::all();
        return Datatables::of($baccount)
                ->addColumn('action', function($item){
                        return '<center><a href="'.url('admin/edit-bank-account').'/'.$item->id.'" class="btn btn-warning" data-title="Edit Akun Bank" title="Edit Akun Bank"><i class="fa fa-edit"></i></a> <a href="'.url('admin/delete_baccount').'/'.$item->id.'" class="btn btn-danger" data-title="Hapus Akun Bank" title="Hapus AKun Bank" id="delete_akun_bank"><i class="fa fa-trash-o"></i></center>';
                })
                ->addColumn('bank_logo', function($bank_logo){
                    return '<center><img src="'.$bank_logo->src.'" width="65px" height="30px"></center>';
                })->rawColumns(['action','bank_logo'])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = 'baccount';
        return view('admin.baccount.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank_logo = $request->bank_logo;
        $rek_no = $request->rek_no;
        $bank = $request->bank;
        $on_behalft = $request->on_behalft;
        $logo_name = time().'-bank-logo-'.$bank_logo->getClientOriginalName();
        $bank_logo->move(public_path('fashe-colorlib/images/icons/'), $logo_name);
        $store = Baccount::create([
            'rek_no' => $rek_no,
            'bank' => $bank,
            'on_behalft' => $on_behalft,
            'bank_logo' => $logo_name
            ]);

        if($store){
            \Session::flash('success', 'Akun Bank Berhasil ditambahkan!');
            return redirect()->route('admin.bank-account');
        }else{
            \Session::flash('failled', 'Akun Bank Gagal ditambahkan!');
            return redirect()->route('admin.bank-account');
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
        $menu = 'baccount';
        $baccount = Baccount::findOrfail($id);
        return view('admin.baccount.edit', compact('baccount', 'menu'));
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
        $baccount = Baccount::find($id);
        $drop_image = \File::delete(public_path().'/fashe-colorlib/images/icons/'.$baccount->bank_logo);
        $bank_logo = $request->bank_logo;
        $rek_no = $request->rek_no;
        $bank = $request->bank;
        $on_behalft = $request->on_behalft;
        $logo_name = time().'-bank-logo-'.$bank_logo->getClientOriginalName();
        $bank_logo->move(public_path('fashe-colorlib/images/icons/'), $logo_name);
        $update = $baccount->update([
            'rek_no' => $rek_no,
            'bank' => $bank,
            'on_behalft' => $on_behalft,
            'bank_logo' => $logo_name
            ]);

        if($update){
            \Session::flash('success', 'Akun Bank Berhasil diupdate!');
            return redirect()->route('admin.bank-account');
        }else{
            \Session::flash('failled', 'Akun Bank Gagal diupdate!');
            return redirect()->route('admin.bank-account');
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
        $baccount = Baccount::findOrfail($id);
        if($baccount){
            $drop_image = \File::delete(public_path().'/fashe-colorlib/images/icons/'.$baccount->bank_logo);
            $delete = $baccount->delete();
            if ($delete) {
                \Session::flash('success', 'Akun Bank Berhasil dihapus!');
                return redirect()->route('admin.bank-account');
            }else{
                \Session::flash('failled', 'Akun Bank Gagal dihapus!');
                return redirect()->route('admin.bank-account');
            }
        }        
    }
}
