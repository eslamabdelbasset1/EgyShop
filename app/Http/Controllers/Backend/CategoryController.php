<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryView()
    {
        $categories = Category::latest()->get();
        return view('backend.category.categoryView', compact('categories'));
    }

    public function categoryStore(Request $request){

        $request->validate([
            'category_name_en' => 'required',
            'category_name_ar' => 'required',
            'category_icon' => 'required',
        ],[
            'category_name_en.required' => 'Input Category English Name',
            'category_name_ar.required' => 'Input Category Arabic Name',
        ]);

        Category::create([
            'category_name_en' => $request->category_name_en,
            'category_name_ar' => $request->category_name_ar,
            'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
            'category_slug_ar' => str_replace(' ', '-',$request->category_name_ar),
            'category_icon' => $request->category_icon,

        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method

    public function categoryEdit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.categoryEdit',compact('category'));

    }

    public function categoryUpdate(Request $request ,$id){



        Category::findOrFail($id)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_ar' => $request->category_name_ar,
            'category_slug_en' => strtolower(str_replace(' ', '-',$request->category_name_en)),
            'category_slug_ar' => str_replace(' ', '-',$request->category_name_ar),
            'category_icon' => $request->category_icon,

        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);


    } // end method

    public function categoryDelete($id){

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


}
