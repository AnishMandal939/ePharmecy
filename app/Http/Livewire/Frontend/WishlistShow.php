<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    // function to remove wishlist item
    public function removeWishlistItem(int $wishlistId)
    {
        // dd($wishlistId);
        Wishlist::where('user_id', auth()->user()->id)->where('id', $wishlistId)->delete();
        // session()->flash('message','Wishlist Item removed Successfully');
        $this->emit('WishlistAddedUpdated');
        $this->dispatchBrowserEvent('message',[
            'text' => 'Wishlist Item removed Successfully',
            'type' => 'success',
            'status' => 200
        ]);
    }
    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist' => $wishlist
        ]);
    }
}
