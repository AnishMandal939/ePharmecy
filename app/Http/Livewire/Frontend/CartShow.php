<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
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
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart-show',[
            'cart' => $cart
        ]);
    }
}
