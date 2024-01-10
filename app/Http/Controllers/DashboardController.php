<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = Category::count();
        $subCategoryCount = SubCategory::count();
        $postCount = Post::count();
        return view('dashboard',compact('categoryCount','subCategoryCount','postCount'));
    }
    public function tables(){
        return view('tables');
    }
}
