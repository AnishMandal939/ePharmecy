<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    //
    public function index()
    {
        # code...
        // fetch data
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    // create slider func
    public function create()
    {
        # code...
        return view('admin.slider.create');

    }

    // store func
    public function store(SliderFormRequest $request)
    {
        # code...
        $validatedData = $request->validated();
        // for image and status check
        if ($request->hasFile('image')) {
            # code...
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }

        // for status
        $validatedData['status'] =  $request->status == true ? '1' : '0';
        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],


        ]);

        return redirect('admin/sliders')->with('message', 'Slider Added Successfully');
    }

    // edit funct
    public function edit(Slider $slider)
    {
        # code...
        
        return view('admin.slider.edit', compact('slider'));
    }

    // update function slider
    public function update(SliderFormRequest $request, Slider $slider)
    {
        # code...
        // return $slider;
        $validatedData = $request->validated();
        // for image and status check
        if ($request->hasFile('image')) {
            # code...
            $destination = $slider->image;
            // check if file exists
            if (File::exists($destination)) {
                # code...
                File::delete($destination);
            }
            // above deletes files and below  upload again
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }

        // for status
        $validatedData['status'] =  $request->status == true ? '1' : '0';
        
        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],


        ]);

        return redirect('admin/sliders')->with('message', 'Slider Updated Successfully');
    }

    // delete function
    public function destroy(Slider $slider)
    {
        # code...
        // return $slider;
        if ($slider->count() >0) {
            # code...

            // delete image
            $destination = $slider->image;
                // check if file exists
                if (File::exists($destination)) {
                    # code...
                    File::delete($destination);
                }
            $slider->delete();
            return redirect('admin/sliders')->with('message', 'Slider Deleted Successfuly');
        }
        return redirect('admin/sliders')->with('message', 'Something Went Wrong');
    }


}
