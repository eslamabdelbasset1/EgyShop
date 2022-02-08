<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id){

        $product = Product::findOrFail($id);
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $product = Product::findOrFail($id);
        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);

        }else{

            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }

    } // end mehtod

    // Mini Cart Section
    public function addMiniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ));
    } // end method

    /// remove mini cart
    public function removeMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove from Cart']);

    } // end method

    // add to wishlist mehtod

    public function addToWishlist(Request $request, $product_id)
    {
        if (Auth::check())
        {
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if (!$exists) {
                Wishlist::Create([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            } else{

            return response()->json(['errors' => 'This Product has Already on Your Wishlist']);

        }

    }else{

            return response()->json(['errors' => 'At First Login Your Account']);

        }
    }


    public function CouponApply(Request $request){
        $coupon = Coupon::where('coupon_name',$request->coupon_name)
            ->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {
//            Session::put('coupon',[
//                'coupon_name' => $coupon->coupon_name,
//                'coupon_discount' => $coupon->coupon_discount,
//                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
//                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((int)Cart::total() * $coupon->coupon_discount / 100, 2),
                'total_amount' => round((int)Cart::total() - (int)Cart::total() * $coupon->coupon_discount / 100, 2)
            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }

    }

    public function couponCalculation(){
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));

        }
    } // end method


    // Remove Coupon
    public function couponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }

    // Checkout Method
    public function checkoutCreate(){
        if (Auth::check()) {
            if (Cart::total() > 0) {

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();

                $divisions = ShipDivision::orderBy('division_name','ASC')->get();
                return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));

            }else{

                $notification = array(
                    'message' => 'Shopping At list One Product',
                    'alert-type' => 'errors'
                );
                return redirect()->to('/')->with($notification);
            }

        }else{

            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'errors'
            );
            return redirect()->route('login')->with($notification);

        }

    } // end method
}
