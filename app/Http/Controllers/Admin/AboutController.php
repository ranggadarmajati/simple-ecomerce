<?php

namespace App\Http\Controllers\Admin;

use App\About;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $menu = 'about';
        return view('admin.about.index', compact('menu'));
    }

    /**
     * Display a listing Of Banner.
     *
     * @return Json
     */
    public function DataTableAbout()
    {
        $about = About::all();
        return Datatables::of($about)
                ->addColumn('action', function($item){
                        return '<center><a href="'.url('admin/edit_about').'/'.$item->id.'" class="btn btn-warning" data-title="Edit Tentang" title="Edit Tentang"><i class="fa fa-edit"></i></a>';
                })
                ->addColumn('image_about', function($image_slide){
                    return '<center><img src="'.$image_slide->src.'" width="250px" height="250px"></center>';
                })->rawColumns(['action','image_about'])->make(true);
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
        $menu   = 'about';
        $type   = 'edit';
        $about = About::find($id);
        return view('admin.about.edit', compact('menu', 'about', 'type'));
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
        $about = About::find($id);
        $content = $request->content;
        $photo = $request->photo;
        if($photo){
        // dd("PHOTO TRUE");    
            $drop_image = \File::delete(public_path().'/fashe-colorlib/images/about/'.$about->image_about);
            $photo_name = time().'-about-'.$photo->getClientOriginalName();
            $photo->move(public_path('fashe-colorlib/images/about/'), $photo_name);
            $update = $about->update([
                'content' => $content,
                'image_about' => $photo_name
            ]);
        }else{
        // dd("PHOTO FALSE");
            $update = $about->update([
                'content' => $content
            ]);
        }

        if($update){
            \Session::flash('success', 'Content Tentang Kami Berhasil diupdate!');
            return redirect()->route('admin.about');
        }else{
            \Session::flash('failled', 'Content Tentang Kami Gagal diupdate!');
            return redirect()->route('admin.about');
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
