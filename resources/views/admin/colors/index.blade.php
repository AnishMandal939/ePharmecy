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
                <h4>Colors List
                    <a href="{{url('admin/colors/create')}}" class="btn btn-primary btn-sm float-end">Add Colors</a>
                </h4>
            </div>
            <div class="card-body">
                {{-- fetching data using livewire - create livewire component -> php artisan make:livewire Admin/Category/Index --}}
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)
                        <tr>
                            <td>{{$color->id}}</td>
                            <td>{{$color->name}}</td>
                            <td>{{$color->code}}</td>
                            <td>{{$color->status ? 'Hidden' : 'Visible'}}</td>
                            <td>
                                <a href="{{ url('admin/colors/'.$color->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{url('admin/colors/'.$color->id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete ?')" class="btn btn-sm btn-danger">Delete</a>
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