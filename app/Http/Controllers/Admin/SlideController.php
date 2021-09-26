<?php

namespace App\Http\Controllers\Admin;

use App\Slide;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class SlideController extends Controller
{
    public function index()
    {
    	$menu = 'slide';
    	return view('admin.slide.index', compact('menu'));
    }

    /**
     * Display a listing Product.
     *
     * @return Json
     */
    public function DataTableSlide()
    {
        $slide = Slide::all();
        return Datatables::of($slide)
                ->addColumn('action', function($item){
                        return '<center><a href="'.url('admin/edit_slide').'/'.$item->id.'" class="btn btn-warning" data-title="Edit Produk" title="Edit Produk"><i class="fa fa-edit"></i></a> <a href="'.url('admin/delete_slide').'/'.$item->id.'" class="btn btn-danger" data-title="Non Aktifkan Produk" title="Delete"><i class="fa fa-trash"></i></a></center>';
                })
                ->addColumn('image_slide', function($image_slide){
                	return '<img src="'.$image_slide->src.'" width="300px" height="140px">';
                })->rawColumns(['action','image_slide'])->make(true);
    }

    public function create()
    {
    	$menu = 'slide';
    	return view('admin.slide.create', compact('menu'));
    }

    public function store(Request $request)
    {
    	$photo = $request->photo;
    	$title = $request->title;
    	$description = $request->description;
        $photo_name = time().'-product-'.$photo->getClientOriginalName();
        $photo->move(public_path('fashe-colorlib/images/slide/'), $photo_name);
        $store = Slide::create([
            'title' => $title,
            'description' => $description,
            'image_slide' => $photo_name
            ]);

        if($store){
        	\Session::flash('success', 'Slide Berhasil ditambahkan!');
        	return redirect()->route('admin.slide');
        }else{
        	\Session::flash('failled', 'Slide Gagal ditambahkan!');
        	return redirect()->route('admin.slide');
        }
        
    }

    public function edit($id)
    {
    	$menu = 'slide';
    	$type = 'edit';
    	$slide = Slide::find($id);
    	return view('admin.slide.edit', compact('menu', 'slide', 'edit'));
    }

    public function update(Request $request, $id)
    {
    	$slide = Slide::find($id);
    	$drop_image = \File::delete(public_path().'/fashe-colorlib/images/slide/'.$slide->image_slide);
    	$photo = $request->photo;
    	$title = $request->title;
    	$description = $request->description;
    	$photo_name = time().'-product-'.$photo->getClientOriginalName();
        $photo->move(public_path('fashe-colorlib/images/slide/'), $photo_name);
        $update = $slide->update([
            'title' => $title,
            'description' => $description,
            'image_slide' => $photo_name
            ]);

        if($update){
        	\Session::flash('success', 'Slide Berhasil diupdate!');
        	return redirect()->route('admin.slide');
        }else{
        	\Session::flash('failled', 'Slide Gagal diupdate!');
        	return redirect()->route('admin.slide');
        }
    }

    public function show($id)
    {
    	$menu = 'slide';
    	$type = 'show';
    	$slide =  Slide::find($id);
    	return view('admin.slide.edit', compact('menu', 'slide', 'show'));
    }

    public function destroy($id)
    {
    	$slide = Slide::find($id);
    	$delete = $slide->delete();
    	if($delete){
    		\Session::flash('success', 'Slide Berhasil dihapus!');
        	return redirect()->route('admin.slide');
    	}else{
    		\Session::flash('failled', 'Slide Gagal dihapus!');
        	return redirect()->route('admin.slide');	
    	}

    }
}
