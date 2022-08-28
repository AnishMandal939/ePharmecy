<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function PHPSTORM_META\type;

class View extends Component
{
    public $category, $product, $productColorSelectedQuantity, $quantityCount = 1, $productColorId;

    // for add to wishlist
    public function addToWishlist($productId)
    {
        // check user authenticated
        if (Auth::check()) {
            # code...
                    // insert wishlist
            if(Wishlist::where('user_id', auth()->user()->id)->where('product_id',$productId)->exists()){
                // if exists true dont add
                // session()->flash('message', ' Already added to wishlist');
                $this->dispatchBrowserEvent('message', ['text' => ' Already added to wishlist', 'type' => 'warning', 'status' => 409]);
                
                return false;
            }else{
            
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('WishlistAddedUpdated');
                // session()->flash('message', ' Wishlist added successfully');
            $this->dispatchBrowserEvent('message', ['text' => 'Wishlist added successfully', 'type' => 'success', 'status' => 200]);


            }

        }else{
            // session()->flash('message', ' Please login to continue');
            // for alertify
            $this->dispatchBrowserEvent('message', ['text' => 'Please login to continue', 'type' => 'info', 'status' => 401]);
            return false;
        }
    }

    // creating function for colorSelected
    public function colorSelected($productColorId)
    {
        # code...
        // dd($productColorId);
        // store product color id to sho product availabe for add to cart 
        $this->productColorId  = $productColorId;
        // filter quantity and show according for stocks 
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        // get quantity 
       $this->productColorSelectedQuantity = $productColor->quantity;

       if ($this->productColorSelectedQuantity == 0) {
        # code...
        $this->productColorSelectedQuantity = 'outOfStock';
       }

    }

    // for quantityCount increment and decrement, create public variable for quantityCount
    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
        $this->quantityCount--;
        }
    }

    // add to cart dunc
    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            // dd('product me');
            if ($this->product->where('id',$productId)->where('status', '0')->exists()) {
               
            // check product color quantity and add to cart, without product color add to cart
            if ($this->product->productColors()->count() > 1 ) {
                # code...
                // dd('inside qun');
                // first store productcolorid in selected color 
                // check if prodcolorquantity available or not
                    if ($this->productColorSelectedQuantity !=NULL) {
                        # code...
                        // check whether product already added to cart 
                            if (Cart::where('user_id',auth()->user()->id)
                                    ->where('product_id',$productId)
                                    ->where('product_color_id',$this->productColorId)
                                    ->exists()) {
                                        $this->dispatchBrowserEvent('message', ['text' => 'Product Already Added', 'type' => 'warning', 'status' => 200]);
                            }else{

                                // dd('color selected'); once color selected check with particular prod Quantity
                                    $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                                    if ($productColor->quantity > 0 ) {
                                        // same condition as quantity check
                                            // if product ko color chaina vana direct add to cart huncha will do direct and ignore quantity check
                                                if ($productColor->quantity > $this->quantityCount) {
                                                    // insert product to cart
                                                    // dd('insert to cart with colors');
                                                    Cart::create([
                                                        'user_id' => auth()->user()->id,
                                                        'product_id' => $productId,
                                                        'product_color_id' => $this->productColorId,
                                                        'quantity' => $this->quantityCount,
                                                    ]);
                                                        // create event emit for update cart in navbar
                                                        $this->emit('CartAddedUpdated');
                                                        $this->dispatchBrowserEvent('message', ['text' => 'Product Added to cart Successfully', 'type' => 'status', 'status' => 200]);
        
                                                }else{
                                                    $this->dispatchBrowserEvent('message', ['text' => 'Only'.$productColor->quantity.'quantity Available', 'type' => 'warning', 'status' => 404]);
                                
                                                }
                                    }else{
                                    $this->dispatchBrowserEvent('message', ['text' => 'Out of Stock', 'type' => 'warning', 'status' => 404]);
                                    }
                                }
                    }else{
                        $this->dispatchBrowserEvent('message', ['text' => 'Select your product color', 'type' => 'info', 'status' => 404]);
                    }
            } else {
                // check if product already aded to cart then
                if (Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()) {
                    # code...
                    // if already added show message
                    $this->dispatchBrowserEvent('message', ['text' => 'Product Already Added', 'type' => 'warning', 'status' => 200]);
                } else {
                    # code...
                    if ($this->product->quantity > 0) {
                        // if product ko color chaina vana direct add to cart huncha will do direct and ignore quantity check
                        if ($this->product->quantity > $this->quantityCount) {
                            // insert product to cart
                            // dd('insert to cart');
                            // same as add to cart like successfully added
    
                            Cart::create([
                                'user_id' => auth()->user()->id,
                                'product_id' => $productId,
                                'quantity' => $this->quantityCount,
                            ]);
                            
                                $this->emit('CartAddedUpdated');
                                $this->dispatchBrowserEvent('message', ['text' => 'Product added to cart successfully', 'type' => 'success', 'status' => 200]);
    
    
                        }else{
                            $this->dispatchBrowserEvent('message', ['text' => 'Only'.$this->product->quantity.'quantity Available', 'type' => 'warning', 'status' => 404]);
        
                        }
    
                    }else{
                        $this->dispatchBrowserEvent('message', ['text' => 'Out of Stock', 'type' => 'warning', 'status' => 404]);
    
                    }
                }
                

            }

            }else{
                $this->dispatchBrowserEvent('message', ['text' => 'Product doesnot exist', 'type' => 'warning', 'status' => 404]);
            }
        }else{
            $this->dispatchBrowserEvent('message', ['text' => 'Please login to Add to cart', 'type' => 'info', 'status' => 401]);
            // return false;
        }
    }
    // use mount fxn 
    public function mount($category, $product)
    {
        # code...
        $this->category = $category; // get category
        $this->product = $product;

    }
    public function render()
    {
        // this targets to livewire blade file
        return view('livewire.frontend.product.view' , [
            'category' =>$this->category,
            'product' =>$this->product,

        ]);
    }
}
