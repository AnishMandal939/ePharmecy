<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
// use Faker\Core\File;
// use Dotenv\Util\Str;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
    //your code
    public function index(){
        return view('admin.category.index');

        // after controller setup routes
    } 
    // create function 
    public function create(){
        return view('admin.category.create');
    }
    // store func
        // create function 
        public function store(CategoryFormRequest $request){
            // here we do form request validation so open terminal and create a request -> php artisan make:request CategoryFormRequest -> if created see inside app/http/requests/filename_you_created
            $validatedData = $request->validated();

            // save data
            $category = new Category;
            $category->name = $validatedData['name'];
            $category->slug = Str::slug($validatedData['slug']); // creating slug
            $category->description = $validatedData['description'];

            // for upload path
            $uploadPath = 'uploads/category/';
            // for image
            if($request->hasFile('image')){
                $file = $request->file('image');

            // get extension from file
            $ext = $file->getClientOriginalExtension();
            // create a  new file name
            $filename = time().'.'.$ext; // filename is created
            // move the file
            $file->move('uploads/category/', $filename);
            // save the records

            $category->image = $uploadPath.$filename; // since image is not data , a file we check condition
            }

            $category->meta_title = $validatedData['meta_title'];
            $category->meta_keyword = $validatedData['meta_keyword'];
            $category->meta_description = $validatedData['meta_description'];

            // for status
            $category->status = $request->status == true ? '1' : '0';

            // for save
            $category->save();

            // return and redirect
            return redirect('admin/category')->with('message', 'Category Added Successfully');
        

        }
    // edit function
    public function edit(Category $category){
        return view('admin.category.edit', compact('category'));
    }

    // update function
    public function update(CategoryFormRequest $request, $category){
        $validatedData = $request->validated();


        $category = Category::findOrFail($category); // #category passed is id of category
        // all below code is same as store 

         // save data
        //  $category = new Category;
         $category->name = $validatedData['name'];
         $category->slug = Str::slug($validatedData['slug']); // creating slug
         $category->description = $validatedData['description'];

        //  now for image is image exist delete and update

         // for image
         if($request->hasFile('image')){
            $uploadPath = 'uploads/category/';
                     // check path 
            $path = 'uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');

         // get extension from file
         $ext = $file->getClientOriginalExtension();
         // create a  new file name
         $filename = time().'.'.$ext; // filename is created
         // move the file
         $file->move('uploads/category/', $filename);
         // save the records

         $category->image = $uploadPath.$filename; // since image is not data , a file we check condition
         }

         $category->meta_title = $validatedData['meta_title'];
         $category->meta_keyword = $validatedData['meta_keyword'];
         $category->meta_description = $validatedData['meta_description'];

         // for status
         $category->status = $request->status == true ? '1' : '0';

         // for save
         $category->update();

         // return and redirect
         return redirect('admin/category')->with('message', 'Category Updated Successfully');
     

    }
    
}
