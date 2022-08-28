<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //your code
    public function index()
    {
        # code...
        // sending variable for view page
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        # code...
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where('status','0')->get();
        return view('admin.products.create', compact('categories', 'brands', 'colors'));
    }

    // store create product, before storing we need to validate lets create ProductFormRequest, php artisan make:request ProductFormRequest
    public function store(ProductFormRequest $request)
    {
        # code...
        // get validated data
        $validatedData = $request->validated();
        // save data
        // check category exist or not  if exist acc to that check
        $category = Category::findOrFail($validatedData['category_id']);
        // found id , now create product, create product function inside category model
       $product = $category->products()->create([
            // create data
            'category_id' =>$validatedData['category_id'],
            'name' =>$validatedData['name'],
            'slug' =>Str::slug($validatedData['slug']),
            'brand' =>$validatedData['brand'],
            'small_description' =>$validatedData['small_description'],
            'description' =>$validatedData['description'],
            'original_price' =>$validatedData['original_price'],
            'selling_price' =>$validatedData['selling_price'],
            'quantity' =>$validatedData['quantity'],
            'trending' =>$request->trending == true ? '1' : '0',
            'status' =>$request->status == true ? '1' : '0',
            'meta_title' =>$validatedData['meta_title'],
            'meta_keyword' =>$validatedData['meta_keyword'],
            'meta_description' =>$validatedData['meta_description'],
        ]);

        // for multiple images
        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/';
            // check with images
            $i =1; // if inserted correctly for image, it is iterating because unique name should be created
            foreach ($request->file('image') as $imageFile) {
                # code...
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath.$filename;
                        // for product images using id, create hasmany reln for productImages in Product modal
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,

                ]);
            }
        }

        // fun for insert product colors
        if ($request->colors) {
            # code... validating by key (id we are getting )
            foreach ($request->colors as $key => $color) {
                # code...
                // get product variable with reln of product table
                // link product colors in product model first(create)
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
            }
        }

        return redirect('/admin/products')->with('message', 'Product Added Successfully');
    }

    // edit function
    public function edit(int $product_id)
    {
        # code...
        $categories = Category::all();
        $brands = Brand::all();
        
        $product = Product::findOrFail($product_id);
        // get only those colors not inserted, create productColors fxn in product model
       $product_color = $product->productColors->pluck('color_id')->toArray();
       $colors = Color::whereNotIn('id', $product_color)->get();

        return view('admin.products.edit', compact('categories', 'brands', 'product', 'colors'));
    }


    // update function
    public function update(ProductFormRequest $request, int $product_id)
    {
        # code...
        // validate data
        $validatedData = $request->validated();
        // we find from validated data
        $product = Category::findOrFail($validatedData['category_id']) // category_id comming from input file,
        // now check for product after validation
                        ->products()->where('id', $product_id)->first(); // check for first record
        // ÷if found
        if ($product) {
            //  update record   // 
            $product->update([
                // same as store
                'category_id' =>$validatedData['category_id'],
                'name' =>$validatedData['name'],
                'slug' =>Str::slug($validatedData['slug']),
                'brand' =>$validatedData['brand'],
                'small_description' =>$validatedData['small_description'],
                'description' =>$validatedData['description'],
                'original_price' =>$validatedData['original_price'],
                'selling_price' =>$validatedData['selling_price'],
                'quantity' =>$validatedData['quantity'],
                'trending' =>$request->trending == true ? '1' : '0',
                'status' =>$request->status == true ? '1' : '0',
                'meta_title' =>$validatedData['meta_title'],
                'meta_keyword' =>$validatedData['meta_keyword'],
                'meta_description' =>$validatedData['meta_description'],
            ]);

            // for image part to upload
                    // for multiple images
                if($request->hasFile('image')){
                    $uploadPath = 'uploads/products/';
                    // check with images
                    $i =1; // if inserted correctly for image, it is iterating because unique name should be created
                    foreach ($request->file('image') as $imageFile) {
                        # code...
                        $extension = $imageFile->getClientOriginalExtension();
                        $filename = time().$i++.'.'.$extension;
                        $imageFile->move($uploadPath, $filename);
                        $finalImagePathName = $uploadPath.$filename;
                                // for product images using id, create hasmany reln for productImages in Product modal
                        $product->productImages()->create([
                            'product_id' => $product->id,
                            'image' => $finalImagePathName,

                        ]);
                    }
                }

                // update product color 
                // fun for insert product colors
                if ($request->colors) {
                    # code... validating by key (id we are getting )
                    foreach ($request->colors as $key => $color) {
                        # code...
                        // get product variable with reln of product table
                        // link product colors in product model first(create)
                        $product->productColors()->create([
                            'product_id' => $product->id,
                            'color_id' => $color,
                            'quantity' => $request->colorquantity[$key] ?? 0
                        ]);
                    }
                }
                
                return redirect('/admin/products')->with('message', 'Product Updated Successfully');

            // image done but not for delete image only upload

        }else{
            return redirect('/admin/products')->with('message', ' No such product id found');
        }
    }

    // function for delete product image
    public function destroyImage(int $product_image_id)
    {
        # code...
        // call product image modal
        $productImage = ProductImage::findOrFail($product_image_id);
        // if found delete data
        // before deleting data we need to delete image also, so check image first
        if (File::exists($productImage->image)) {
            # code...
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product Images Deleted Successfully');

    }

    // delete product function
    public function destroy(int $product_id)
    {
        # code...
        // get id , search product 
        $product = Product::findOrFail($product_id);
        // delete image first and then product
        if($product->productImages){
            foreach ($product->productImages as $image) {
                # code...
                // check whether file exists or not
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        // now delete product after image deletion
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully with all its image');

    }

    // for color select do in create function

    // create fxn for prodColorQty update
    public function updateProdColorQty(Request $request, $prod_color_id)
    {
        # code...
        // search for product , validate and then update
        $productColorData = Product::findOrFail($request->product_id)
                                    ->productColors()->where('id', $prod_color_id)->first(); // getting using relation
        $productColorData->update([
            'quantity' => $request->qty
        ]);
        return response()->json(['message'=> 'Product Color Quantity Updated']);
    }

    // for delete
    public function deleteProdColor($prod_color_id)
    {
        # code...
        $prodColor = ProductColor::findOrFail($prod_color_id);
        $prodColor->delete();
        return response()->json(['message'=> 'Product Color  Deleted']);

    }

}
