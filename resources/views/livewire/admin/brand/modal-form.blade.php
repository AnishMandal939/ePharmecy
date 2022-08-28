
   <!-- Modal -->
   <div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="storeBrand">
            {{-- @csrf --}}
            <div class="modal-body">
              <div class="mb-3">
                <label>Select Category</label>
                <select wire:model.defer="category_id" class="form-control" required>
                  <option value="">--Select Category--</option>
                  @foreach ($categories as $cateItem)
                      
                  <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                  @endforeach
                </select>
                @error('category_id')<small class="text-danger">{{$message}}</small>@enderror
              </div>
                <div class="mb-3">
                    <label>Brand Name</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Brand Slug</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Brand Status</label>
                    <input type="checkbox" wire:model.defer="status" /><small class="text-info mx-2">Checked- Hidden, Unchecked-Visible</small>
                    @error('status')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  {{-- modal container end --}}


  {{-- brand update model --}}

   <!-- Modal -->
   <div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Brand</h5>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- spinner loader --}}
        <div wire:loading class="p-2 text-center">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
        {{-- hide form when its loading --}}
        <div class="hiding_on_loading" wire:loading.remove>

          <form wire:submit.prevent="updateBrand">
              {{-- @csrf --}}
              <div class="modal-body">
                <div class="mb-3">
                  <label>Select Category</label>
                  <select wire:model.defer="category_id" class="form-control" required>
                    <option value="">--Select Category--</option>
                    @foreach ($categories as $cateItem)
                        
                    <option value="{{$cateItem->id}}">{{$cateItem->name}}</option>
                    @endforeach
                  </select>
                  @error('category_id')<small class="text-danger">{{$message}}</small>@enderror
                </div>
                  <div class="mb-3">
                      <label>Brand Name</label>
                      <input type="text" wire:model.defer="name" class="form-control">
                      @error('name')
                          <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label>Brand Slug</label>
                      <input type="text" wire:model.defer="slug" class="form-control">
                      @error('slug')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label>Brand Status</label>
                      <input type="checkbox" wire:model.defer="status" style="width: 20px; height:20px;" /><small class="text-info mx-2">Checked- Hidden, Unchecked-Visible</small>
                      @error('status')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Update</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- modal container end --}}


  {{-- for delete modal --}}
    {{-- brand update model --}}

   <!-- Modal -->
   <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Brand</h5>
          <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- spinner loader --}}
        <div wire:loading class="p-2 text-center">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
        {{-- hide form when its loading --}}
        <div class="hiding_on_loading" wire:loading.remove>
          <form wire:submit.prevent="destroyBrand">

            <div class="modal-body">
            Are you sure you want to delete this data ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Yes , Delete</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  {{-- modal container end --}}