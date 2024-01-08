<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SubCategory::with('category')->paginate(25);
        if (request()->ajax()) {
            return view('subCategory.table', compact('data'))->render();
        }
        return view('subCategory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('subCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|integer'
        ]);
        SubCategory::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Sub Category Created Successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $sub_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $sub_category)
    {
        $categories = Category::all();
        return view('subCategory.edit', compact('sub_category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $sub_category)
    {
        $data = $request->validate([
            'name'=>'required|max:255',
            'category_id' => 'required|integer'
        ]);
        
        $sub_category->update($data);
        return response()->json([
            'status'=>'success',
            'message'=>'Sub Category Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $sub_category)
    {
        if($sub_category->delete()){
            return response()->json([
                'status'=>'success',
                'message'=>'Sub Category Deleted Successfully!'
            ]);
        }else{
            return response()->json([
                'status'=>'error',
                'message'=>'Error! Some problem has occurred'
            ]);
        }
    }
}
