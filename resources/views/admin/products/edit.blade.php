@extends('layouts.admin')

@section('content')

{{-- <h2 class="mx-auto mt-2 rounded p-2 bg-primary bg-label-light">Duplicate this page and add content here</h2> --}}
<div class="row container-xxl mt-2">
    <div class="col-md-12">
        @if (session('message'))
        <h4 class="alert alert-success mb-2">{{ session('message') }}</h4>

        @endif
        <div class="card">
            <div class="card-header">
                <h5>Edit Product
                    <a href="{{url('admin/products')}}" class="btn btn-danger btn-sm float-end">Back</a>
                </h5>
            </div>
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-warning">
                  @foreach ($errors->all() as $error)
                      <div>{{$error}}</div>
                  @endforeach
                </div>
            @endif
              <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                        {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>

                      </li>
                      <li class="nav-item" role="presentation">
                        {{-- <a class="nav-link" href="#">Link</a> --}}
                        <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab-pane" aria-selected="false">SEO Tags</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">Details</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">Product Image</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="colors-tab" data-bs-toggle="tab" data-bs-target="#colors-tab-pane" type="button" role="tab" aria-controls="colors-tab-pane" aria-selected="false">Product Color</button>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show border p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="mb-3">
                          <label>Select Category</label>
                          <select name="category_id" id="" class="form-control">
                            @foreach ($categories as $category)
                            {{-- on the basis of selected condition update all other field using value --}}
                            <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>
                                {{$category->name}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        <div class="mb-3">
                          <label>Product Name</label>
                          <input type="text" name="name" value="{{$product->name}}" class="form-control" />
                        </div>
                        <div class="mb-3">
                          <label>Product Slug</label>
                          <input type="text" name="slug" value="{{$product->slug}}" class="form-control" />
                        </div>
                        {{-- brands --}}
                        <div class="mb-3">
                          <label>Select Brand</label>
                          <select name="brand" id="" class="form-control">
                            @foreach ($brands as $brand)
                            <option value="{{$brand->name}}" {{$brand->name == $product->brand ? 'selected' : ''}}>
                                {{$brand->name}}
                            </option>
                            @endforeach
                          </select>
                        </div>
                        {{-- description small --}}
                        <div class="mb-3">
                          <label>Small Description <small>500 words</small></label>
                          <textarea name="small_description" id="" rows="4" class="form-control">{{$product->small_description}}</textarea>
                        </div>
                        <div class="mb-3">
                          <label>Description</label>
                          <textarea name="description" id="" rows="4" class="form-control">{{$product->description}}</textarea>
                        </div>
                        {{-- home tabs form end inside --}}
                      </div>
                      <div class="tab-pane fade show border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">SEO Tag
                        {{-- description small --}}
                        <div class="mb-3">
                          <label>Meta Title</small></label>
                          <input type="text" name="meta_title" value="{{$product->meta_title}}" id="" class="form-control" />
                        </div>
                        <div class="mb-3">
                          <label>Meta Keyword</label>
                          <textarea name="meta_keyword" id="" rows="4" class="form-control">{{$product->meta_keyword}}</textarea>
                        </div>
                        <div class="mb-3">
                          <label>Meta Description</label>
                          <textarea name="meta_description" id="" rows="4" class="form-control">{{$product->meta_description}}</textarea>
                        </div>
                      </div>
                      <div class="tab-pane fade show border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">Details
                        <div class="row">
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Original Price</small></label>
                              <input type="text" name="original_price" value="{{$product->original_price}}" id="" class="form-control" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Selling Price</small></label>
                              <input type="text" name="selling_price" value="{{$product->selling_price}}" id="" class="form-control" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Quantity</small></label>
                              <input type="number" name="quantity" value="{{$product->quantity}}" id="" class="form-control" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Trending</small></label>
                              <input type="checkbox" {{$product->trending == '1' ? 'checked' : ''}} name="trending" />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="mb-3">
                              <label>Status</small></label>
                              <input type="checkbox" name="status" {{$product->status == '1' ? 'checked' : ''}} />
                            </div>
                          </div>

                        </div>
                      </div>
                      {{-- for images --}}
                      <div class="tab-pane fade show border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                        <div class="mb-3">
                          <label>Upload Product Images</label>
                          <input type="file" name="image[]" multiple id="" class="form-control" />
                        </div>
                        {{-- for preview images --}}
                        <div>
                            @if($product->productImages)
                            {{-- if image uploaded loop it foeeach --}}
                            <div class="row">
                                @foreach ($product->productImages as $image)
                                <div class="col-md-2">
                                
                                    <img src="{{ asset($image->image)}}" alt="img" style="width: 80px; height:80px;" class="md-4 border" />
                                    {{-- for delete image --}}
                                    <a href="{{ url('admin/product-image/'.$image->id.'/delete') }}" class="d-block">Remove</a>
                                </div>
                                @endforeach
                            </div>            
                            @else
                                <h5>No Image Uploaded</h5>
                            @endif
                        </div>
                      </div>
                      {{-- for colors --}}
                        <div class="tab-pane fade show border p-3" id="colors-tab-pane" role="tabpanel" aria-labelledby="colors-tab" tabindex="0">
                          <div class="mb-3">
                            <h4>Add Product Color</h4>
                            <label class="mb-1">Select Product Color</label><hr />
                            <div class="row">
                              @forelse ($colors as $coloritem)
                                  
                              <div class="col-md-3">
                                <div class="p-2 border mb-3">
                                  Color: <input type="checkbox" value="{{$coloritem->id}}" name="colors[{{$coloritem->id}}]" /> {{$coloritem->name}}
                                  <br/>
                                  Quantity: <input type="number" name="colorquantity[{{$coloritem->id}}]" class=" border mt-1 w-50" />
                                </div>
                              </div>
                              @empty
                                  <div class="col-md-12">
                                    <h5>No colors found</h5>
                                  </div>
                              @endforelse
                            </div>
                          </div>
                          {{-- for already selected colors --}}
                          <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                              <thead>
                                <tr>
                                  <th>Color Name</th>
                                  <th>Color Quantity</th>
                                  <th>Delete</th>
                                 
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($product->productColors as $prodColor)                                    
                                  <tr class="prod-color-tr">
                                    {{-- create reln of color to get name in prodcolor --}}
                                    <td>
                                      {{-- condn if prodColor->color available show name  --}}
                                      @if ($prodColor->color)
                                      {{$prodColor->color->name}}
                                      @else
                                      No Color Found
                                      @endif
                                    </td>
                                    <td>
                                      <div class="input-group mb-3" style="width:150px">
                                        <input type="text" value="{{$prodColor->quantity}}" class="productColorQuantity form-control form-control-sm">
                                        <button type="button" value="{{$prodColor->id}}" class="updateProductColorBtn btn btn-primary btn-sm text-white">Update</button>
                                      </div>
                                    </td>
                                    <td>
                                      <button type="button" value="{{$prodColor->id}}" class="deleteProductColorBtn btn btn-danger btn-sm text-white">Delete</button>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>

                    </div>
                    {{-- outside of tab-content --}}
                    <div>
                      <button type="submit" class="btn btn-primary float-end">Update</button>
                    </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- ajax call , make sure you have yeild this section in layouts admin--}}
@section('scripts')
  <script>
    $(document).ready(function(){
      // pasting lara csrf token here before btn click
          $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

      $(document).on('click', '.updateProductColorBtn', function(){
        // get value
        var product_id = "{{$product->id}}";
        var prod_color_id = $(this).val();
        var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();
        // alert(prod_color_id);

        // ajax to update
        // check if qty has input or not
        if(qty <= 0){
          alert('Quantity is required');
          return false;
        }
        // if found ignore
        // create data
        var data ={
          'product_id': product_id,
          // 'prod_color_id': prod_color_id, if sending in ajax dont require here
          'qty' : qty
        };

        // ajax call 
        $.ajax({
          type: "POST",
          url: "/admin/product-color/"+prod_color_id,
          data: data,
          // dataType: "dataType",
          success: function(response){
            alert(response.message);
            // if using ajax in laravel we should send csrf token paste before btn click
          }
        });
      });
    // for delete
    $(document).on('click', '.deleteProductColorBtn', function(){
      // get prod color id
      var prod_color_id = $(this).val();
      var thisClick = $(this);
      // thisClick.closest('.prod-color-tr').remove(); testing

      // ajax to delete record
      $.ajax({
          type: "GET",
          url: "/admin/product-color/"+prod_color_id+"/delete",
        
          success: function(response){
            thisClick.closest('.prod-color-tr').remove();
            alert(response.message);
           
          }
        });
    });

    });
  </script>
@endsection