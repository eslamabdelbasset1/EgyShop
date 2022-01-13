<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function subCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategories = SubCategory::latest()->get();
        return view('backend.category.subCategoryView', compact('subCategories', 'categories'));
    }

    public function subCategoryStore(Request $request){

        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_ar' => 'required',
        ],[
            'category_id.required' => 'Please select Any option',
            'subcategory_name_en.required' => 'Input SubCategory English Name',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ar' => $request->subcategory_name_ar,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
            'subcategory_slug_ar' => str_replace(' ', '-',$request->subcategory_name_ar),
        ]);

        $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


    public function subCategoryEdit($id){
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subCategoryEdit',
            compact('subcategory','categories'));

    }

    public function subCategoryUpdate(Request $request){

        $subcat_id = $request->id;

        SubCategory::findOrFail($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_ar' => $request->subcategory_name_ar,
            'subcategory_slug_en' => strtolower(str_replace(' ', '-',$request->subcategory_name_en)),
            'subcategory_slug_ar' => str_replace(' ', '-',$request->subcategory_name_ar),
        ]);

        $notification = array(
            'message' => 'SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.subcategory')->with($notification);

    }  // end method



    public function subCategoryDelete($id){

        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

//    =================== Sub subCategory ===================================

    public function subSubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subSubCategories = SubSubCategory::latest()->get();
        return view('backend.category.subSubCategoryView', compact('subSubCategories', 'categories'));
    }

    public function getSubCategory($category_id)
    {
        $subCategory = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subCategory);
    }
}
