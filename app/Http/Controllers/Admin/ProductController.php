<?php

namespace App\Http\Controllers\Admin;

use File;
use Session;
use App\Size;
use App\Color;
use App\Image;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'product';
        return view('admin.product.index', compact('menu'));
    }

    /**
     * Display a listing Product.
     *
     * @return Json
     */
    public function DataTableProduct()
    {
        $product = Product::all();
        return Datatables::of($product)
                ->addColumn('action', function($item){
                    if($item->available){

                        return '<center><a href="'.url('admin/detail_product').'/'.$item->id.'" class="btn btn-success" data-title="LIhat Detail" title="Lihat Detail"><i class="fa fa-eye"></i></a> <a href="'.url('admin/edit_product').'/'.$item->id.'" class="btn btn-warning" data-title="Edit Produk" title="Edit Produk"><i class="fa fa-edit"></i></a> <a href="'.url('admin/activated_product').'/'.$item->id.'" class="btn btn-danger" data-title="Non Aktifkan Produk" title="Non Aktifkan Produk"><i class="fa fa-check"></i></a></center>';
                    }else{
                        return '<center><a href="'.url('admin/detail_product').'/'.$item->id.'" class="btn btn-success" data-title="LIhat Detail" title="Lihat Detail"><i class="fa fa-eye"></i></a> <a href="'.url('admin/edit_product').'/'.$item->id.'" class="btn btn-warning" data-title="Edit Produk" title="Edit Produk"><i class="fa fa-edit"></i></a> <a href="'.url('admin/activated_product').'/'.$item->id.'" class="btn btn-danger" data-title="Aktifkan Produk" title="Aktifkan Produk"><i class="fa fa-ban"></i></a></center>';
                    }
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = 'product';
        $category = Category::all();

        return view('admin.product.create', compact('category', 'menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        $array_size = explode(',', $request->size); 
        $array_color = explode(',', $request->color);
        
        foreach ($array_size as $size){
            Size::create([
                'product_id' => $product->id,
                'size' => $size
            ]);
        }
        
        foreach ($array_color as $color) {
            Color::create([
                'product_id' => $product->id,
                'color' => $color
            ]);
        }
        
        foreach ($request->photos as $photo) {
            $photo_name = time().'-product-'.$photo->getClientOriginalName();
            $photo->move(public_path('fashe-colorlib/images/product/'), $photo_name);
            $store_photo = Image::create([
                'product_id' => $product->id,
                'image' => $photo_name
            ]);

        }
        \Session::flash('success', 'Produk Berhasil ditambahkan!');
        return redirect()->route('admin.product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('Images', 'Categories', 'Colors','Sizes')->find($id);
        $category = Category::all();
        $value_size = array();
        $value_color = array();
        $menu = 'product';

        foreach ($product->sizes as $key => $value) {
            $value_size[] = $value['name'];
        }

        foreach ($product->colors as $key => $value) {
            $value_color[] = $value['name'];
        }

        $size = implode(',', $value_size);
        $color = implode(',', $value_color);
        
        return view('admin.product.show', compact('product','category','size', 'color', 'menu'));
        // return response()->json(['results' => [ 'product' => $product, 'category' => $category, 'size' => $size, 'color' => $color ]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('Images', 'Categories', 'Colors','Sizes')->find($id);
        $category = Category::all();
        $value_size = array();
        $value_color = array();
        $menu = 'product';

        foreach ($product->sizes as $key => $value) {
            $value_size[] = $value['name'];
        }

        foreach ($product->colors as $key => $value) {
            $value_color[] = $value['name'];
        }

        $size = implode(',', $value_size);
        $color = implode(',', $value_color);
        
        return view('admin.product.edit', compact('product','category','size', 'color', 'menu'));
        // return response()->json(['results' => [ 'product' => $product, 'category' => $category, 'size' => $size, 'color' => $color ]]);
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
        $product = Product::with('Images', 'Categories', 'Colors','Sizes')->find($id);
        $product->update($request->all());
        // $array_size = explode(',', $request->size); 
        // $array_color = explode(',', $request->color);
        
            
        // foreach ($product->sizes as $key) {
            // foreach ($array_size as $size){
            // $update_size = Size::UpdateOrCreate([
            //         'product_id' => $product->id,
            //         'size' => $size
            //     ]);
            //     \Log::info($size);
                // $update_size->update(['size' => $size]);
            // }
        // }
            // $update_size = Size::where('product_id', $id);
            // $update_size->update([ 'size' => $size ]);
        
        // foreach ($array_color as $color) {
        //     $update_color = Color::where('product_id', $id);
        //     $update_color->update(['color' => $color]);
        // }
        
        // foreach ($request->photos as $photo) {
        //     $photo_name = time().'-product-'.$photo->getClientOriginalName();
        //     $photo->move(public_path('fashe-colorlib/images/product/'), $photo_name);
        //     $store_photo = Image::create([
        //         'product_id' => $product->id,
        //         'image' => $photo_name
        //     ]);

        // }
        \Session::flash('success', 'Produk Berhasil diupdate!');
        return redirect()->route('admin.product');
    }

    /**
     * Update Size the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSize(Request $request, $id)
    {
        $size = Size::find($id);
        $size->update([ 'size' => $request->size ]);
       
        \Session::flash('success', 'Size Berhasil diupdate!');
        return redirect()->back();
    }

    /**
     * Add Size the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addSize(Request $request, $product_id)
    {
        $size = Size::create([
            'product_id' => $product_id,
            'size' => $request->size
            ]);
       
        \Session::flash('success', 'Size Berhasil ditambahkan!');
        return redirect()->back();
    }

    /**
     * Remove Size the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_size($id)
    {
        $size = Size::find($id);
        if($size){
            $delete = $size->delete();
            if($delete){
                \Session::flash('success', 'Size berhasil dihapus!');
                return redirect()->back();
            }else{
                \Session::flash('failled', 'Size gagal dihapus!');
                return redirect()->back();
            }
        
        }else{
            
            \Session::flash('failled', 'Size tidak ditemukan!');
            return redirect()->back();
        }
    }

    /**
     * Update Color the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_color(Request $request, $id)
    {
        $color = Color::find($id);
        $color->update([ 'color' => $request->color ]);
       
        \Session::flash('success', 'Warna Berhasil diupdate!');
        return redirect()->back();
    }

    /**
     * Add Color the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addColor(Request $request, $product_id)
    {
        $color = Color::create([
            'product_id' => $product_id,
            'color' => $request->color
            ]);
       
        \Session::flash('success', 'Warna Berhasil ditambahkan!');
        return redirect()->back();
    }

    /**
     * Remove Color the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_color($id)
    {
        $color = Color::find($id);
        if($color){
            $delete = $color->delete();
            if($delete){
                \Session::flash('success', 'Warna berhasil dihapus!');
                return redirect()->back();
            }else{
                \Session::flash('failled', 'Warna gagal dihapus!');
                return redirect()->back();
            }
        
        }else{
            
            \Session::flash('failled', 'Warna tidak ditemukan!');
            return redirect()->back();
        }
    }

    /**
     * Add Image the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addImage(Request $request, $product_id)
    {
        foreach ($request->photos as $photo) {
            $photo_name = time().'-product-'.$photo->getClientOriginalName();
            $photo->move(public_path('fashe-colorlib/images/product/'), $photo_name);
            $store_photo = Image::create([
                'product_id' => $product_id,
                'image' => $photo_name
            ]);

        }
       
        \Session::flash('success', 'Foto Berhasil ditambahkan!');
        return redirect()->back();
    }

    /**
     * Edit Image the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editImage(Request $request, $id)
    {   
        $image = Image::find($id);
        $drop_image = \File::delete(public_path().'/fashe-colorlib/images/product/'.$image->image);
        if($image){
            foreach ($request->photos as $photo) {
                $photo_name = time().'-product-'.$photo->getClientOriginalName();
                $photo->move(public_path('fashe-colorlib/images/product/'), $photo_name);
                $store_photo = $image->update(['image' => $photo_name]);
            }
            \Session::flash('success', 'Foto Berhasil diedit!');
             return redirect()->back();
        
        }else{
            \Session::flash('failled', 'Foto tidak bisa diedit!');
             return redirect()->back();
        }
    }

    /**
     * Delete Image the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request, $id)
    {   
        $image = Image::find($id);
        $drop_image = \File::delete(public_path().'/fashe-colorlib/images/product/'.$image->image);
        if($image){
            $image->delete();
            \Session::flash('success', 'Foto Berhasil dihapus!');
             return redirect()->back();
        
        }else{
            \Session::flash('failled', 'Foto tidak bisa dihapus!');
             return redirect()->back();
        }
    }


    /**
     * Activated Product specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activated_product($id)
    {
        $product = Product::find($id);
        if($product){
            $available = $product->available;
            if($available){
                $activated = $product->update(['available' => false]);
                \Session::flash('success', 'Product '.$product->name.' berhasil dinonaktifkan!');
                return redirect()->back();    
            }else{
                $activated = $product->update(['available' => true]);
                \Session::flash('success', 'Product '.$product->name.' berhasil diaktifkan!');
                return redirect()->back();
            }
        
        }else{
            
            \Session::flash('failled', 'Product tersebut tidak ada di database!');
            return redirect()->back();
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
