<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartPageController extends Controller
{
    public function myCart(){
        return view('frontend.wishlist.view_mycart');

    }


    public function getCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),

        ));

    } //end method

    public function removeCartProduct($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Successfully Remove From Cart']);
    }

    // Cart Increment
    public function cartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        return response()->json('increment');
    } // end method
    // Cart Decrement
    public function cartDecrement($rowId){

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json('Decrement');
    }// end method
}
