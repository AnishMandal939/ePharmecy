{{-- this is livewire compoenent for category index --}}
{{-- category index.blade.php section moved here template --}}

{{-- delete modal here --}}
{{-- main div start --}}
<div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Category Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroyCategory">

                <div class="modal-body">
                Are you sure you want to delete this data ?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
        </div>

    </div>
    <div class="row container-xxl mt-2">
        <div class="col-md-12">
            {{-- for message if added category --}}
            @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
                
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Category
                        <a href="{{url('admin/category/create')}}" class="btn btn-primary btn-sm float-end">Add Category</a>
                    </h4>
                </div>
                <div class="card-body">
                    {{-- fetching data using livewire - create livewire component -> php artisan make:livewire Admin/Category/Index --}}
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/category/'.$category->id.'/edit')}}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="#" wire:click="deleteCategory({{$category->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-danger">Delete</a>

                                </td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    {{-- pagination --}}
                    <div class="pagination float-end mt-1">

                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- main div end --}}
</div>

{{-- to close modal after delete --}}
@push('script')
    {{-- ot use this import in main file of categ for this , go to admin.blade.php --}}
    {{-- listen here after dispatch --}}
    <script>
        window.addEventListener('close-modal', event=>{
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush