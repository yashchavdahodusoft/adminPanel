<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::paginate(10);
        if (request()->ajax()) {
            return view('category.table', compact('data'))->render();
        }
        return view('category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|max:255'
        ]);
        Category::create($data);
        return response()->json([
            'status'=>'success',
            'message'=>'Category Created Successfully!'
        ]);
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
    public function edit(Category $category)
    {
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'=>'required|max:255'
        ]);
        $category->update($data);
        return response()->json([
            'status'=>'success',
            'message'=>'Category Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $posts_count  = $category->posts()->count();
        $sub_cat_count = $category->subCategories()->count();
        if($posts_count>0 || $sub_cat_count>0){
            return response()->json([
                'status'=>'error',
                'message'=>'Total ' . $posts_count . ' Posts found connected to this Category.<br/> Total '.$sub_cat_count.' Sub Catgories found connected to this Category. <br/> Can not remove this Category'
            ]);
        }else{
            if($category->delete()){
                return response()->json([
                    'status'=>'success',
                    'message'=>'Category Deleted Successfully!'
                ]);
            }else{
                return response()->json([
                    'status'=>'error',
                    'message'=>'Error! Some problem has occurred'
                ]);
            }
        }
        
    }
}
