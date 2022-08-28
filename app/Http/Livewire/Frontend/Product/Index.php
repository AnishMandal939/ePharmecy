<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    // assign here whatever youare taking for mount
    public $products, $category, $brandInputs = [],$priceInput;

    protected $queryString = [
        'brandInputs' => ['except' => '', 'as' => 'brand'],
        'priceInput' => ['except' => '', 'as' => 'price'],

    ];
    // on page loads func mount, remove $ product from here and put in render fxn
    public function mount($category)
    {
        # code...
        // $this->products = $products;
        $this->category = $category;
    }
    public function render()
    {
        // $products = $category->products()->get();
        $this->products = Product::where('category_id', $this->category->id)
                                    // for filter condition
                                    ->when($this->brandInputs, function($q){
                                        $q->whereIn('brand', $this->brandInputs);
                                    })
                                    // for price
                                    ->when($this->priceInput, function($q){
                                        
                                        $q->when($this->priceInput == 'high-to-low', function($q2){
                                            $q2->orderBy('selling_price', 'DESC');
                                        })
                                        ->when($this->priceInput == 'low-to-high', function($q2){
                                            $q2->orderBy('selling_price', 'ASC');
                                        });
                                    })
                                    ->where('status','0')
                                    ->get();

        return view('livewire.frontend.product.index',[
            // this is used when using livewire t=otherwise we dont need to pass in array
            'products' =>$this->products,
            'category' =>$this->category,

        ]);
    }
}
