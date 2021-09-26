<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = 'view';
        $menu = 'contact';
        $contact = Contact::all()->first();
        $gmap_apikey = env('gmap_apikey');
        return view('admin.contact.index', compact('contact', 'type', 'menu', 'gmap_apikey'));
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
        $type = 'edit';
        $menu = 'contact';
        $contact = Contact::find($id);
        $gmap_apikey = env('gmap_apikey');
        return view('admin.contact.index', compact('contact', 'type', 'menu', 'gmap_apikey'));
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
        $input = $request->all();
        $contact = Contact::find($id);
        $update = $contact->update($input);
        
        if($update){
            \Session::flash('success', 'Kontak Berhasil diupdate!');
            return redirect()->route('admin.contact');
        }else{
            \Session::flash('failled', 'Kontak Gagal diupdate!');
            return redirect()->route('admin.contact');
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
}
