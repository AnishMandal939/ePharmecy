<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        return view('frontend.index', compact('sliders'));
    }
    // all categories
    public function categories()
    {
        // get category
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }
    // get products by category func
    public function products($category_slug)
    {
        // search if categ exists
        $category = Category::where('slug',$category_slug)->first();
        if ($category) {
            # code...
            // check by  relation category has many products, category model, define if not defined with products func here used  
            // $products = $category->products()->get(); -> moving to direct get data from livewire index controller only for products
            return view('frontend.collections.products.index', compact('category'));
        }else{
            return redirect()->back();
        }

    }

    // product view function
    public function productView(string $category_slug, string $product_slug)
    {
        // check category slug if available
        $category = Category::where('slug',$category_slug)->first();
        if ($category) {

            // check product if availabe category hasMany product reln
            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if ($product) {
                # code...
                return view('frontend.collections.products.view', compact('product','category'));
            }else{
            return redirect()->back();
            }

        }else{
            return redirect()->back();
        }
    }
}
