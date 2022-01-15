<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->limit(6)->get();
        $featured = Product::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        $hot_deals = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
        $special_offer = Product::where('special_offer',1)->orderBy('id','DESC')->limit(6)->get();
        $special_deals = Product::where('special_deals',1)->orderBy('id','DESC')->limit(3)->get();
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status',1)->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->get();
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status',1)->where('category_id',$skip_category_1->id)->orderBy('id','DESC')->get();
        $skip_brand_1 = Brand::skip(1)->first();
        $skip_brand_product_1 = Product::where('status',1)->where('brand_id',$skip_brand_1->id)->orderBy('id','DESC')->get();
        return view('frontend.index',
            compact('categories', 'sliders', 'products', 'featured',
                'hot_deals', 'special_offer', 'special_deals','skip_category_0','skip_product_0',
                'skip_category_1','skip_product_1','skip_brand_1','skip_brand_product_1'
            ));
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.userprofile', compact('user'));
    }

    public function userUpdateProfile(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user/profile/'.$data->profile_photo_path));
            $fileName =  Carbon::now()->format('Y-m-d-H-i').$file->getClientOriginalName();
            $file->move(public_path('upload/user/profile'),$fileName);
            $data['profile_photo_path'] = $fileName;
        }
        $data->save();

        $notifications = array(
            'message' => 'User profile is updated',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notifications);
    }

    public function userChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.userChangePassword', compact('user'));
    }

    public function userUpdatePassword(Request $request)
    {
        $validatePassword = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->current_password,$hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notifications = array(
                'message' => 'New Password is updated',
                'alert-type' => 'success'
            );
            return redirect()->route('user.logout')->with($notifications);
        }else
        {
            $notifications = array(
                'message' => 'Password is incorrect',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notifications);
        }

    }

    public function productDetails($id,$slug){
        $product = Product::findOrFail($id);
        $multiImag = MultiImg::where('product_id',$id)->get();
        return view('frontend.product.product_details',compact('product', 'multiImag'));

    }
    public function tagWiseProduct($tag){
        $products = Product::where('status',1)->where('product_tags_en',$tag)
            ->where('product_tags_ar',$tag)->orderBy('id','DESC')->get();
        $categories = Category::orderBy('category_name_en','ASC')->get();
        return view('frontend.tags.tagsView',compact('products', 'categories'));

    }


}
