<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{
    public $wishlistCount;
    // WishlistAddedUpdated
    // for firing and listening event 
    protected $listeners = ['WishlistAddedUpdated' => 'checkWishlistCount'];
    public function checkWishlistCount()
    {
        if(Auth::check()){
            return $this->wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
        }else{
            return $this->wishlistCount =0;
        }
    }
    public function render()
    {
        $this->wishlistCount = $this->checkWishlistCount();
        return view('livewire.frontend.wishlist-count',[
            // send data here
            'wishlistCount' => $this->wishlistCount
        ]);
    }
}
