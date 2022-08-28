@extends('layouts.admin')

@section('content')

{{-- <h2 class="mx-auto mt-2 rounded p-2 bg-primary bg-label-light">Duplicate this page and add content here</h2> --}}
{{-- here container are moved to livewire component --}}
{{-- connect livewire --}}
{{-- <div> --}}
    {{-- <livewire:admin.category.index /> --}}
{{-- </div> --}}

<div class="row container-xxl mt-2">
    <div class="col-md-12">
        {{-- for message if added product --}}
        @if (session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
            
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Products
                    <a href="{{url('admin/products/create')}}" class="btn btn-primary btn-sm float-end">Add Product</a>
                </h4>
            </div>
            <div class="card-body">
                {{-- fetching data using livewire - create livewire component -> php artisan make:livewire Admin/Category/Index --}}
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                {{-- cross check if we miss category then show --}}
                                @if ($product->category)
                                {{ $product->category->name }}
                                @else
                                No Category
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->selling_price }}</td>
                            <td>{{ $product->quantity }}</td>

                            <td>{{ $product->status == '1' ? 'Hidden' : 'Visible' }}</td>
                            <td>
                                <a href="{{ url('admin/products/'.$product->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{url('admin/products/'.$product->id.'/delete')}}" onClick="return confirm('Are you sure, you want to delete ?')" class="btn btn-sm btn-danger">Delete</a>
                                {{-- <a href="#" wire:click="deleteProduct({{$product->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-danger">Delete</a> --}}

                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Products Available</td>
                            </tr>
                        @endforelse
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