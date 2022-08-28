@extends('layouts.admin')

@section('content')

<div class="row container-xxl mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Slider
                    <a href="{{url('admin/sliders')}}" class="btn btn-danger btn-sm float-end">Back</a>
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
            <form action="{{url('admin/sliders/create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT') --}}
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" />
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea type="text" name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" />
                </div>
                <div class="mb-3">
                    <label>Status</label><br />
                    <input type="checkbox" name="status" /> <small class="text-info">Checked = hidden, unchecked = visible</small>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>
@endsection