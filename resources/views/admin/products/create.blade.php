@extends('layouts.admin')

@section('content')

{{-- <h2 class="mx-auto mt-2 rounded p-2 bg-primary bg-label-light">Duplicate this page and add content here</h2> --}}
<div class="row container-xxl mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Product
                    <a href="{{url('admin/products')}}" class="btn btn-danger btn-sm float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
              @if ($errors->any())
                  <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                  </div>
              @endif
                <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                          <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab-pane" aria-selected="false">Product Color</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show border p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                          <div class="mb-3">
                            <label>Select Category</label>
                            <select name="category_id" id="" class="form-control">
                              @foreach ($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="name" value="" class="form-control" />
                          </div>
                          <div class="mb-3">
                            <label>Product Slug</label>
                            <input type="text" name="slug" value="" class="form-control" />
                          </div>
                          {{-- brands --}}
                          <div class="mb-3">
                            <label>Select Brand</label>
                            <select name="brand" id="" class="form-control">
                              @foreach ($brands as $brand)
                              <option value="{{$brand->name}}">{{$brand->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          {{-- description small --}}
                          <div class="mb-3">
                            <label>Small Description <small>500 words</small></label>
                            <textarea name="small_description" id="" rows="4" class="form-control"></textarea>
                          </div>
                          <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" id="" rows="4" class="form-control"></textarea>
                          </div>
                          {{-- home tabs form end inside --}}
                        </div>
                        <div class="tab-pane fade show border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">SEO Tag
                          {{-- description small --}}
                          <div class="mb-3">
                            <label>Meta Title</small></label>
                            <input type="text" name="meta_title" id="" class="form-control" />
                          </div>
                          <div class="mb-3">
                            <label>Meta Keyword</label>
                            <textarea name="meta_keyword" id="" rows="4" class="form-control"></textarea>
                          </div>
                          <div class="mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" id="" rows="4" class="form-control"></textarea>
                          </div>
                        </div>
                        <div class="tab-pane fade show border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">Details
                          <div class="row">
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label>Original Price</small></label>
                                <input type="text" name="original_price" id="" class="form-control" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label>Selling Price</small></label>
                                <input type="text" name="selling_price" id="" class="form-control" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label>Quantity</small></label>
                                <input type="number" name="quantity" id="" class="form-control" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label>Trending</small></label>
                                <input type="checkbox" name="trending" />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label>Status</small></label>
                                <input type="checkbox" name="status" />
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
                        </div>
                        {{-- for colors --}}
                        <div class="tab-pane fade show border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                          <div class="mb-3">
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
                        </div>

                      </div>
                      {{-- outside of tab-content --}}
                      <div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection