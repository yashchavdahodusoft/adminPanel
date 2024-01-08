<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = Category::count();
        $subCategoryCount = SubCategory::count();
        return view('dashboard',compact('categoryCount','subCategoryCount'));
    }
    public function tables(){
        return view('tables');
    }
}
