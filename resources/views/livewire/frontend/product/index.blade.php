<div>
    {{-- Stop trying to control. --}}
    {{-- for flter --}}
    <div class="row">
        <div class="col-md-3">
            @if ($category->brands)
                
            <div class="card">
                <div class="card-header"><h4>Brands</h4></div>
                <div class="card-body">
                    @foreach ($category->brands as $brandItem)                        
                    <label for="" class="d-block">
                        <input type="checkbox" wire:model="brandInputs" value="{{$brandItem->name}}" />{{$brandItem->name}}
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- price filter --}}
            <div class="card">
                <div class="card-header"><h4>Price</h4></div>
                <div class="card-body">
                    <label for="" class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low" />High to Low
                    </label>
                    <label for="" class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high" />Low to High
                    </label>
                </div>
            </div>

            {{-- price filter end --}}
        </div>
        <div class="col-md-9">
            {{-- products start --}}
            <div class="row">
                @forelse ($products as $productItem)                
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if ($productItem->quantity > 0)   
                            <label class="stock bg-success">In Stock</label>
                            @else
                            <label class="stock bg-danger">Out of Stock</label>
                            @endif
        
                            {{-- <label class="stock bg-success">{{$productItem->status == 0 ? 'In Stock' : 'Not Available'}} </label> --}}
                            {{-- since we dont have roduct images in product table fetching from produt_images table we need to get from that table only one image , so inside product model get image and pass in compact and use here, from product images has many reln get here --}}
                            @if ($productItem->productImages->count() > 0)
                            <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                <img src="{{asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}">
                            </a>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <p class="product-brand">{{$productItem->brand}} </p>
                            <h5 class="product-name">
                               <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                    {{$productItem->name}} 
                               </a>
                            </h5>
                            <div>
                                <span class="selling-price">{{$productItem->selling_price}} </span>
                                <span class="original-price">{{$productItem->original_price}} </span>
                            </div>
                            {{-- <div class="mt-2">
                                <a href="" class="btn btn1">Add To Cart</a>
                                <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                <a href="" class="btn btn1"> View </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                @empty
                    <div class="col-md-12 p-2">
                        <h5>No Products Available for {{ $category->name}}</h5>
                    </div>
                @endforelse
            </div>
            {{-- products end  --}}
        </div>
    </div>
    {{-- filter end --}}

</div>
