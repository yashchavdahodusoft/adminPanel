<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::with('category', 'sub_category')->paginate(25);
        if (request()->ajax()) {
            return view('post.table', compact('data'))->render();
        }
        return view('post.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view('post.create', compact('categories', 'sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Post::create($request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'description' => 'required'
        ]));
        return response()->json([
            'status' => 'success',
            'message' => 'Post Created Successfully!'
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
    public function edit(Post $post)
    {
        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view('post.edit', compact('categories', 'sub_categories','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'description' => 'required'
        ]));
        return response()->json([
            'status' => 'success',
            'message' => 'Post Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Post Deleted Successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Error! Some problem has occurred'
            ]);
        }
    }
    public function uploadImageFormCkEditor(Request $request){
        if($request->hasFile('upload')){
            // $original_name = $request->file('upload')->getClientOriginalName();
            // $filename = pathinfo($original_name,PATHINFO_FILENAME);
            // $extension = $request->file('upload')->getClientOriginalExtension();
            // $filename = $filename.'_'.time().'.'.$extension;

            // $request->file('upload')->move(public_path('media'),$filename);
            

            $file = $request->file('upload');
            $path = $file->store('uploads','public');
            $url = asset('storage/' . $path);
            return response()->json([
                'fileName'=>$path,
                'uploaded'=>1,
                'url'=>$url
            ]);
        }
    }
}
