<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    //
    public function index()
    {
        # code...
        $colors = Color::all();
        return view('admin.colors.index', compact('colors'));
    }

    // create function
    public function create()
    {
        # code...
        return view('admin.colors.create');
    }

    // function for create store data, do form request validation
    public function store(ColorFormRequest $request)
    {
        # code...
        // check for request validated
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';
        Color::create($validatedData);
        return redirect('admin/colors')->with('message', 'Color Added Successfully');
    }

    // edit function
    public function edit(Color $color)
    {
        # code...
        // return $color;
        // return $color;
        return view('admin.colors.edit', compact('color'));

    }

    // update func
    public function update(ColorFormRequest $request, $color_id)
    {
        # code...
        // check for request validated
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1' : '0';
        Color::find($color_id)->update($validatedData);
        return redirect('admin/colors')->with('message', 'Color updated Successfully');
    }

    // delete color func
    public function destroy(int $color_id)
    {
        # code...
        $color = Color::findOrFail($color_id);

        $color->delete();
        return redirect()->back()->with('message', 'Color Deleted Successfully');
    }
}
