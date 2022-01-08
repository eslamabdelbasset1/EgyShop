<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function categoryView()
    {
        $subcategories = SubCategory::latest()->get();
        return view('backend.category.categoryView', compact('subcategories'));
    }
}
