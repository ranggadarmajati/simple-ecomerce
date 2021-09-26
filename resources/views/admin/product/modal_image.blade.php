<!-- Modal Add Image-->
<div class="modal fade" id="myModal_add_image" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: orange;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="color: white;">Tambah Foto</h4>
</div>
<div class="modal-body">
{!! Form::open([
            'route' => ['admin.add_image', $product->id],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-add-color']) 
!!}
<div class="form-group">
<label>Foto</label>
<input type="file" name="photos[]" multiple="multiple" id="photosnew">
<hr>
<img src="{{ URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="imagenew_view">      
</div>
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Simpan</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<!-- End Modal Add Image-->

<!-- Modal Edit Image1-->
<div class="modal fade" id="myModal_add_image1" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: orange;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="color: white;">Edit Foto</h4>
</div>
<div class="modal-body">
{!! Form::open([
            'route' => ['admin.update_image', isset($product->images[0]->id) ? $product->images[0]->id : null],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-add-color']) 
!!}
<div class="form-group">
<label>Foto 1</label>
<input type="file" name="photos[]" multiple="multiple" id="photos1">
<hr>
<img src="{{ isset($product->images[0]->src) ? $product->images[0]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="image1_view">   
</div>
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('admin.delete_image', isset($product->images[0]->id) ? $product->images[0]->id : null) }}" class="btn btn-danger" onclick="return confirm('Anda yakin untuk hapus foto ini?')">Delete</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<!-- End Modal Edit Image1-->

<!-- Modal Edit Image2-->
<div class="modal fade" id="myModal_add_image2" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: orange;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="color: white;">Edit Foto</h4>
</div>
<div class="modal-body">
{!! Form::open([
            'route' => ['admin.update_image', isset($product->images[1]->id) ? $product->images[1]->id : null],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-add-color']) 
!!}
<div class="form-group">
<label>Foto 2</label>
<input type="file" name="photos[]" multiple="multiple" id="photos2">
<hr>
<img src="{{ isset($product->images[1]->src) ? $product->images[1]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="image2_view">   
</div>
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('admin.delete_image', isset($product->images[1]->id) ? $product->images[1]->id : null) }}" class="btn btn-danger" onclick="return confirm('Anda yakin untuk hapus foto ini?')">Delete</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<!-- End Modal Edit Image2-->

<!-- Modal Edit Image3-->
<div class="modal fade" id="myModal_add_image3" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: orange;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="color: white;">Edit Foto</h4>
</div>
<div class="modal-body">
{!! Form::open([
            'route' => ['admin.update_image', isset($product->images[2]->id) ? $product->images[2]->id : null],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-add-color']) 
!!}
<div class="form-group">
<label>Foto 3</label>
<input type="file" name="photos[]" multiple="multiple" id="photos3">
<hr>
<img src="{{ isset($product->images[2]->src) ? $product->images[2]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="image3_view">   
</div>
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('admin.delete_image', isset($product->images[2]->id) ? $product->images[2]->id : null) }}" class="btn btn-danger" onclick="return confirm('Anda yakin untuk hapus foto ini?')">Delete</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<!-- End Modal Edit Image3-->

<!-- Modal Edit Image4-->
<div class="modal fade" id="myModal_add_image4" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="background-color: orange;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="color: white;">Edit Foto</h4>
</div>
<div class="modal-body">
{!! Form::open([
            'route' => ['admin.update_image', isset($product->images[3]->id) ? $product->images[3]->id : null ],
            'role' => 'form',
            'enctype' => 'multipart/form-data',
            'files' => true,
            'id' => 'form-add-color']) 
!!}
<div class="form-group">
<label>Foto 4</label>
<input type="file" name="photos[]" multiple="multiple" id="photos4">
<hr>
<img src="{{ isset($product->images[3]->src) ? $product->images[3]->src : URL::asset('fashe-colorlib/images/item-01.jpg') }}" class="img img-responsive" id="image4_view">   
</div>
<div class="modal-footer">  
<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ route('admin.delete_image', isset($product->images[3]->id) ? $product->images[3]->id : null) }}" class="btn btn-danger" onclick="return confirm('Anda yakin untuk hapus foto ini?')">Delete</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<!-- End Modal Edit Image4-->