<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart;
        // function to remove wishlist item
        public function removeCartItem(int $cartId)
        {
            // dd($wishlistId);
            Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->delete();
            // session()->flash('message','Wishlist Item removed Successfully');
            // $this->emit('CartAddedUpdated');
            $this->dispatchBrowserEvent('message',[
                'text' => 'Cart Item removed Successfully',
                'type' => 'success',
                'status' => 200
            ]);
        }
    
    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();

        return view('livewire.frontend.cart.cart-show',[
            'cart' => $this->cart
        ]);
    }
}
