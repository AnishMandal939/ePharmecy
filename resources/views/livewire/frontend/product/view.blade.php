<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="py-3 py-md-5">
        <div class="container">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif

            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border">
                        @if ($product->productImages->count() >0)
                        <img src="{{asset($product->productImages[0]->image)}}" class="w-100" alt="Img">
                        @else
                        <div class="blink_me">
                            <small>No Image Added Here 😢</small>
                            <small>Comming Soon..</small>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name}}
                            {{-- <label class="label-stock bg-success">In Stock</label> --}}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{$product->category->name}} / {{$product->name}}
                        </p>
                        <div>
                            <span class="selling-price">{{$product->selling_price}}</span>
                            <span class="original-price">{{$product->original_price}}</span>
                        </div>
                        {{-- colors section --}}
                        <div>
                            @if ($product->productColors->count() > 0)
                                
                                @if ($product->productColors)
                                    @foreach ($product->productColors as $colorItem)
                                        {{-- <input type="radio" name="colorSelection" value="{{$colorItem->id}}" /> {{$colorItem->color->name}} --}}
                                        <label for="" class="colorSelectionLabel" style="background-color: {{$colorItem->color->code}}"
                                            {{-- create colorSelected fxn in its view class view.php --}}
                                            wire:click="colorSelected({{$colorItem->id}})"
                                            >
                                            {{$colorItem->color->name}}
                                        </label>
                                    @endforeach
                                @endif
                                <div>
                                    {{-- for in stock and outof stock --}}
                                    @if ($this->productColorSelectedQuantity == 'outOfStock')
                                        <label class="btn btn-sm py-1 mt-2 btn-danger">Out of Stock</label>
                                    @elseif($this->productColorSelectedQuantity > 0)
                                        <label class="btn btn-sm py-1 mt-2 btn-success">In Stock</label>
                                    @endif
                                {{-- stock end --}}
                                </div>
                            @else
                                @if ($product->quantity)
                                    <label class="btn btn-sm py-1 mt-2 btn-success">In Stock</label>
                                @else
                                    <label class="btn btn-sm py-1 mt-2 btn-danger">Out of Stock</label>
                                @endif

                            @endif
                        </div>
                        {{-- colors end --}}
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity" ><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{$this->quantityCount}}" class="input-quantity" readonly/>
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn1">
                                 <i class="fa fa-shopping-cart"></i>
                                  Add To Cart</button>
                            <button type="button" wire:click="addToWishlist({{$product->id}})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishlist">
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishlist">Adding...</span>
                                 </button>

                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!!$product->small_description!!}
                                {{-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!!$product->description!!}
                                {{-- Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
