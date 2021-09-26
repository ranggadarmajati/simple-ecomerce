<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'banner';
        return view('admin.banner.index', compact('menu'));
    }

    /**
     * Display a listing Of Banner.
     *
     * @return Json
     */
    public function DataTableBanner()
    {
        $banner = Banner::all();
        return Datatables::of($banner)
                ->addColumn('action', function($item){
                        return '<center><a href="'.url('admin/edit_banner').'/'.$item->id.'" class="btn btn-warning" data-title="Edit Banner" title="Edit Banner"><i class="fa fa-edit"></i></a>';
                })
                ->addColumn('image_banner', function($image_slide){
                    return '<center><img src="'.$image_slide->src.'" width="250px" height="250px"></center>';
                })->rawColumns(['action','image_banner'])->make(true);
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
        $menu   = 'banner';
        $type   = 'edit';
        $banner = Banner::find($id);
        return view('admin.banner.edit', compact('menu', 'banner', 'type'));
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
        $banner = Banner::find($id);
        $drop_image = \File::delete(public_path().'/fashe-colorlib/images/banner/'.$banner->image_banner);
        $photo = $request->photo;
        $photo_name = time().'-banner-'.$photo->getClientOriginalName();
        $photo->move(public_path('fashe-colorlib/images/banner/'), $photo_name);
        $update = $banner->update([
            'image_banner' => $photo_name
            ]);

        if($update){
            \Session::flash('success', 'Banner Berhasil diupdate!');
            return redirect()->route('admin.banner');
        }else{
            \Session::flash('failled', 'Banner Gagal diupdate!');
            return redirect()->route('admin.banner');
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
