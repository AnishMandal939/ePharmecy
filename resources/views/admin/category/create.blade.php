@extends('layouts.admin')

@section('content')

{{-- <h2 class="mx-auto mt-2 rounded p-2 bg-primary bg-label-light">Duplicate this page and add content here</h2> --}}
<div class="row container-xxl mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Category
                    <a href="{{url('admin/category')}}" class="btn btn-danger btn-sm float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" />
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control" />
                            @error('slug')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        {{-- 2nd form --}}
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                            @error('description')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" />
                        </div>
                        {{-- 3rd --}}
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status" /><br />
                        </div>
                        {{-- for seo tags --}}
                        <div class="col-md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" />
                            @error('meta_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        {{-- 4th --}}
                        <div class="col-md-6 mb-3">
                            <label>Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control"></textarea>
                            @error('meta_keyword')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control"></textarea>
                            @error('meta_description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        {{-- submit button --}}
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection