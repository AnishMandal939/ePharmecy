<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCount extends Component
{
    public $cartCount;

    // listening to event listners for add to cart updateron nav
    protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];
    public function checkCartCount()
    {
        if(Auth::check()){
            return $this->cartCount = Cart::where('user_id', auth()->user()->id)->count();
        }else{
            return $this->cartCount = 0;
        }
    }
    public function render()
    {
        // send data
        $this->cartCount = $this->checkCartCount();
        return view('livewire.frontend.cart.cart-count', [
            'cartCount' => $this->cartCount
        ]);
    }
}
