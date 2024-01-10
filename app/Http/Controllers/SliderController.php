<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Slider::paginate(10);
        if (request()->ajax()) {
            return view('slider.table', compact('data'))->render();
        }
        return view('slider.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('image');
        if ($file !== null) {
            $path = $file->store('uploads', 'public');
            if (!empty($path)) {
                Slider::create(['image' => $path]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Slider Image Uploaded Suceessfully!'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error! Some Problem has occurred !'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Please Select the Image Before Pressing on submit',
                'data' => request()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $file = $request->file('image');
        if ($file !== null) {
            $path = $file->store('uploads', 'public');
            if (!empty($path)) {
                //File::delete(asset('storage/'.$slider->image));
                unlink(public_path('storage/'.$slider->image));
                $slider->update(['image' => $path]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Slider Image Uploaded Suceessfully!'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error! Some Problem has occurred !'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Please Select the Image Before Pressing on submit',
                'data' => request()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        unlink(public_path('storage/'.$slider->image));
        if($slider->delete()){
            return response()->json([
                'status'=>'success',
                'message'=>'Slider Image Deleted Successfully!'
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Error! Some problem has occurred'
            ]);
        }
    }
}
