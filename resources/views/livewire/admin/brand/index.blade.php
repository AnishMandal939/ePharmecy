<div>
{{-- include modal blade --}}
@include('livewire.admin.brand.modal-form')

    <div class="row container mt-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Brands List</h4>
                    <a href="#" class="btn btn-sm btn-primary float-end" wire:click="openModal" data-bs-toggle="modal" data-bs-target="#addBrandModal">Add Brands</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id}}</td>
                                <td>{{ $brand->name}}</td>

                                <td>
                                    {{-- showing using reln , create reln in brand model--}}
                                    @if ($brand->category)
                                    {{ $brand->category->name}}
                                    @else
                                    <small>No Category Found</small>
                                    @endif
                                </td>
                                <td>{{ $brand->slug}}</td>
                                <td>{{ $brand->status == 1 ? 'hidden' : 'visible'}}</td>
                                <td>
                                    <a href="#" wire:click="editBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#updateBrandModal" class="btn btn-sm btn-success">Edit</a>
                                    <a href="#" wire:click="deleteBrand({{$brand->id}})" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Brands Found</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    <div class="pagination float-end mt-1">
                        {{$brands->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- to close modal after delete --}}
@push('script')
    {{-- ot use this import in main file of categ for this , go to admin.blade.php --}}
    {{-- listen here after dispatch --}}
    <script>
        window.addEventListener('close-modal', event=>{
            $('#addBrandModal').modal('hide');
            $('#updateBrandModal').modal('hide');
            $('#deleteBrandModal').modal('hide');


        });
    </script>
@endpush