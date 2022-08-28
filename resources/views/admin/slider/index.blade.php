@extends('layouts.admin')

@section('content')
<div class="row container-xxl mt-2">
  <div class="col-md-12">
      {{-- for message if added product --}}
      @if (session('message'))
      <div class="alert alert-success">{{session('message')}}</div>
          
      @endif
      <div class="card">
          <div class="card-header">
              <h4>Sliders List
                  <a href="{{url('admin/sliders/create')}}" class="btn btn-primary btn-sm float-end">Add Slider</a>
              </h4>
          </div>
          <div class="card-body">
              {{-- fetching data using livewire - create livewire component -> php artisan make:livewire Admin/Category/Index --}}
              <table class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Slider Title</th>
                          <th>Slider Description</th>
                          <th>Image</th>
                          <th>Status</th>
                          <th>Action</th>

                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($sliders as $slider)
                          <tr>
                            <td>{{$slider->id}}</td>

                            <td>{{$slider->title}}</td>
                            <td>{{$slider->description}}</td>
                            <td>
                              <img src="{{ asset("$slider->image") }}" style="width: 70px; height:70px;" alt ="slider" />
                            </td>
                            <td>{{$slider->status == '0' ?'Visible' : 'Hidden'}}</td>
                            <td>
                              <a href="{{url('admin/sliders/'.$slider->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>
                              <a href="{{url('admin/sliders/'.$slider->id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete?')" class="btn btn-sm btn-danger">Delete</a>

                            </td>
                            

                          </tr>
                      @endforeach
                      {{-- <tr>
                          <td colspan="5">No colors available</td>
                      </tr> --}}
                  </tbody>
              </table>
              {{-- pagination --}}
              <div class="pagination float-end mt-1">

                  {{-- {{ $categories->links() }} --}}
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
