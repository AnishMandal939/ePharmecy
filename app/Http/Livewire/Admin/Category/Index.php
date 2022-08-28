<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // declarecateg id
    public $category_id;
    // delete 
    public function deleteCategory($category_id){
        // dd($category_id);
        $this->category_id = $category_id; //storing here
    }

    // destroy categ
    public function destroyCategory(){
        // dd($category_id);
       $category = Category::find($this->category_id);
    //    we also need to find image to delete
    // path
    $path = 'uploads/category/'.$category->image;

    if(File::exists($path)){
        File::delete($path);
    }

    // once image deleted delete cate
    $category->delete();
    // show session message
    session()->flash('message', 'Category deleted');
    // after delete dispatch event
    $this->dispatchBrowserEvent('close-modal'); // listen in  livewire blade
    }
    
    public function render()
    {
        // your code for categories
        // $categories = Category::all(); this shows all for pagination do below
        $categories = Category::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.admin.category.index', ['categories'=> $categories]);
    }
}
