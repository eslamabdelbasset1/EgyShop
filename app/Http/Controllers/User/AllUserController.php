<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllUserController extends Controller
{
    public function myOrders(){

        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_view',compact('orders'));

    }

    public function orderDetails($order_id){

        $order = Order::with('division','district','state','user')
            ->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('frontend.user.order.order_details',compact('order','orderItem'));

    } // end mehtod

    public function invoiceDownload($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        // return view('frontend.user.order.order_invoice',compact('order','orderItem'));
        $pdf = PDF::loadView('frontend.user.order.order_invoice',
            compact('order','orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    } // end mehtod

    public function returnOrder(Request $request,$order_id){

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);


        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('my.orders')->with($notification);

    } // end method
    public function returnOrderList(){

        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.user.order.return_order_view',compact('orders'));

    } // end method

    public function cancelOrders(){

        $orders = Order::where('user_id',Auth::id())->where('status','cancel')->orderBy('id','DESC')->get();
        return view('frontend.user.order.cancel_order_view',compact('orders'));

    } // end method

    ///////////// Order Traking ///////

    public function orderTracking(Request $request){
        $invoice = $request->code;

        $track = Order::where('invoice_no',$invoice)->first();

        if ($track) {

            // echo "<pre>";
            // print_r($track);

            return view('frontend.tracking.track_order',compact('track'));

        }else{

            $notification = array(
                'message' => 'Invoice Code Is Invalid',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }
    } // end method
}
