<div>
    {{-- Be like water. --}}
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
    
            <div class="row">
                <div class="col-md-8">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                {{-- <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div> --}}
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>    
                            @forelse ($cart as $cartItem)
                                
                            <div class="cart-item">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <a href="{{ url('collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug)}}">
                                            <label class="product-name">
                                                {{-- if($cartItem->product->productImages.count() > 0) --}}
                                                <img src="{{$cartItem->product->productImages[0]->image}}" style="width: 50px; height: 50px" alt="{{$cartItem->product->name}}">
                                               {{$cartItem->product->name}}
                                            </label>
                                        </a>
                                    </div>
                                    <div class="col-md-2 my-auto">
                                        <label class="price">{{$cartItem->product->selling_price}}</label>
                                    </div>
                                    {{-- <div class="col-md-2 col-7 my-auto">
                                        <div class="quantity">
                                            <div class="input-group">
                                                <span class="btn btn1"><i class="fa fa-minus"></i></span>
                                                <input type="text" value="1" class="input-quantity" />
                                                <span class="btn btn1"><i class="fa fa-plus"></i></span>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-2 col-7 my-auto">
                                        <div class="remove">
                                            <button type="buttom" wire:click="removeCartItem({{$cartItem->id}})" class="btn btn-danger btn-sm">
                                                <span wire:loading.remove wire:target="removeCartItem({{$cartItem->id}})">
                                                    <i class="fa fa-trash"></i> Remove
                                                </span>
                                                <span wire:loading wire:target="removeCartItem({{$cartItem->id}})"> <i class="fa fa-trash"></i> Removing...</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <h4 class="col-md-12">No Product Added to cart</h4>
                                
                            @endforelse                           
                                           
                    </div>
                </div>

                {{-- checkout container --}}
                <div class="col-md-4 border">
                    <div class="checkout-card">
                        <h4>Checkout card comes here</h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
