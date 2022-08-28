@extends('layouts.admin')

@section('content')

<div class="row container-xxl mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Colors
                    <a href="{{url('admin/colors')}}" class="btn btn-danger btn-sm float-end">Back</a>
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
            <form action="{{url('admin/colors/create')}}" method="POST">
                @csrf
                {{-- @method('PUT') --}}
                <div class="mb-3">
                    <label>Color Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Color Code</label>
                    <input type="text" name="code" class="form-control">
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