<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    // import class of paginate
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    // create function to create brand or store brand
    // if using livewire type modal you have to define it in public
    public $name, $slug, $status, $brand_id, $category_id;
    // validation before storing data creating rules
    public function rules(){
        return[
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|integer',
            'status' => 'nullable'
        ];
    }

    // after data submitted reset function to empty form
    public function resetInput()
    {
        # code...
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        // when deleted brand reset it to null
        $this->brand_id = NULL;
        $this->category_id = NULL;


    }
    public function storeBrand(){
        // get data 
        $validatedData = $this->validate();
        // create / insert data
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id,

        ]);
        session()->flash('message', 'Brands Added Successfully');
        // close modal
        // after delete dispatch event
        $this->dispatchBrowserEvent('close-modal'); // listen in  livewire blade
        // after modal close calling reset input function
        $this->resetInput();
    
    }
    // function on close modal clear input 
    public function closeModal()
    {
        # code...
        $this->resetInput();
    }

    // same for open modal while open data should be blank
    public function openModal()
    {
        # code...
        $this->resetInput();
    }
    // function for update edit
    public function editBrand(int $brand_id)
    {
        # code...
        $this->brand_id = $brand_id; // getting here for update func
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id = $brand->category_id;

    }

    // for update brand func
    public function updateBrand()
    {
        # code... same as store part
         // get data 
         $validatedData = $this->validate();
         // create / insert data
         Brand::findOrFail($this->brand_id)->update([
             'name' => $this->name,
             'slug' => Str::slug($this->slug),
             'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id,
 
         ]);
         session()->flash('message', 'Brands Updated Successfully');
         // close modal
         // after delete dispatch event
         $this->dispatchBrowserEvent('close-modal'); // listen in  livewire blade
         // after modal close calling reset input function
         $this->resetInput();
    }

    // delete data
    public function deleteBrand($brand_id)
    {
        # code...
            //    dd($brand_id);
       $this->brand_id = $brand_id; // storing

    }

    // for destroy 
    public function destroyBrand()
    {
        # code...
        Brand::findOrFail($this->brand_id)->delete();
               // show session message
       session()->flash('message', 'Brand deleted Successfully');
       // after delete dispatch event
       $this->dispatchBrowserEvent('close-modal'); // listen in  livewire blade
        // after modal close calling reset input function
        $this->resetInput();
    }

    public function render()
    {
        // for fetching
        // $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        // return view('livewire.admin.brand.index', ['brands' -> $brands])
        // ->extends('layouts.admin')
        // ->section('content');
        // get category
        $categories = Category::where('status', '0')->get();
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
        ->extends('layouts.admin')
        ->section('content');
    }
}
