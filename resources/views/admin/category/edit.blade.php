@extends('layouts.admin')

@section('content')

{{-- <h2 class="mx-auto mt-2 rounded p-2 bg-primary bg-label-light">Duplicate this page and add content here</h2> --}}
<div class="row container-xxl mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Category
                    <a href="{{url('admin/category')}}" class="btn btn-danger btn-sm float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- to update use put method --}}
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" value="{{$category->name}}" class="form-control" />
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" value="{{$category->slug}}" class="form-control" />
                            @error('slug')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        {{-- 2nd form --}}
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{$category->description}}</textarea>
                            @error('description')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" />
                            <img src="{{ asset('/uploads/category/'.$category->image)}}" width="60px" height="60px" alt="cat_img" />
                        </div>
                        {{-- 3rd --}}
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status" {{$category->status == '1' ? 'checked' : ''}} /><br />
                        </div>
                        {{-- for seo tags --}}
                        <div class="col-md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control" />
                            @error('meta_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        {{-- 4th --}}
                        <div class="col-md-6 mb-3">
                            <label>Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control">{{$category->meta_keyword}}</textarea>
                            @error('meta_keyword')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control">{{$category->meta_description}}</textarea>
                            @error('meta_description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        {{-- submit button --}}
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection