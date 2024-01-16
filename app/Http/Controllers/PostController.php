<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Code;
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
        $row_id = uniqid();
        return view('post.create', compact('categories', 'sub_categories', 'row_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'description' => 'required'
        ]);

        $file = $request->file('image');
        if ($file !== null) {
            $path = $file->store('uploads', 'public');
            if (!empty($path)) {
                $data['img'] = $path;
            }
        }
        $output = $request->only('output');
        $data['output'] = $output['output'];
        $post = Post::create($data);

        //CREATING CODES
        $data = $request->all();
        $code_keys = array_filter($data, function ($key) {
            return preg_match('/^code_key_/', $key);
        }, ARRAY_FILTER_USE_KEY);

        foreach ($code_keys as $code_key) {
            // echo "<pre/>";
            $row = array_filter($data, function ($key) use ($code_key) {
                return str_contains($key, $code_key);
            }, ARRAY_FILTER_USE_KEY);
            $values['title'] = $row['code_title_' . $code_key] ?? '';
            $values['language'] = $row['code_language_' . $code_key] ?? '';
            $values['description'] = $row['code_description_' . $code_key] ?? '';
            $values['content'] = $row['code_content_' . $code_key] ?? '';
            // print_r($row);
            if ($values['title'] != '' && $values['language'] != '' && $values['description'] != '' && $values['content'] != '') {
                $post->codes()->create($values);
            }
        }

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
        $row_id = uniqid();
        $codes = $post->codes;
        return view('post.edit', compact('categories', 'sub_categories', 'post', 'row_id', 'codes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'description' => 'required'
        ]);

        $file = $request->file('image');
        if ($file !== null) {
            $path = $file->store('uploads', 'public');
            if (!empty($path)) {
                $data['img'] = $path;
            }
        }
        $output = $request->only('output');
        $data['output'] = $output['output'];

        $post->update($data);

        //CREATING CODES
        $data = $request->all();
        $code_keys = array_filter($data, function ($key) {
            return preg_match('/^code_key_/', $key);
        }, ARRAY_FILTER_USE_KEY);

        foreach ($code_keys as $code_key) {
            $row = array_filter($data, function ($key) use ($code_key) {
                return str_contains($key, $code_key);
            }, ARRAY_FILTER_USE_KEY);
            $values['title'] = $row['code_title_' . $code_key] ?? '';
            $values['language'] = $row['code_language_' . $code_key] ?? '';
            $values['description'] = $row['code_description_' . $code_key] ?? '';
            $values['content'] = $row['code_content_' . $code_key] ?? '';
            $values['code_id'] = $row['code_id_' . $code_key] ?? '';

            if ($values['title'] != '' && $values['language'] != '' && $values['description'] != '' && $values['content'] != '') {
                if (!empty($values['code_id'])) {
                    $code = Code::findOrFail($values['code_id']);
                    $code->update($values);
                } else {
                    $post->codes()->create($values);
                }
            }
        }

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
    public function uploadImageFormCkEditor(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $path = $file->store('uploads', 'public');
            $url = asset('storage/' . $path);
            return response()->json([
                'fileName' => $path,
                'uploaded' => 1,
                'url' => $url
            ]);
        }
    }
    public function createCodeSection()
    {
        $row_number  = uniqid();
        return view('post.codeSection', compact('row_number'));
    }
}
