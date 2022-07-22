<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductSubImage;
use App\Models\OrderDetails;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\Http\Requests\ProductRequest;
use DB;
use Auth;
use PDF;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function paymentStore(Request $request){

		$member_data = session('member_data');

    	$this->validate($request,[
    		'payment_method' => 'required',
    		'trx_num' =>  'required',
    		'payment_from_mobile' =>  'required',
    		'payment_to_mobile' =>  'required',

    		'shipping_date' =>  'required',

    		'order_total' =>  'required',
    		'address' =>  'required',
    	]);

    	$payment =new Payment();
    	$payment->payment_method = $request->payment_method;
    	$payment->trx_num = $request->trx_num;
    	$payment->payment_from_mobile = $request->payment_from_mobile;
    	$payment->payment_to_mobile = $request->payment_to_mobile;
    	$payment->member_id = $member_data->id;
    	$payment-> save();
    	
    	$order = new Order();
    	$order->member_id = $member_data->id;
    	$order->shipping_date= $request->shipping_date;
    	$order->payment_id= $payment->id;

		$order->order_no = uniqid();
		$order->order_total = (int)$request ->order_total;
		$order->address = $request ->address;
		$order->status = 'Pending';
		$order->save();

		$carts = Cart::where('member_id', $member_data->id)->get();

		foreach ($carts as $cart) {
			$order_details = new OrderDetails();
			$order_details->order_id= $order->id;
			$order_details->product_id = $cart->product_id;
			$order_details->product_name = $cart->product_name;
			$order_details->product_image = $cart->product_image;
			$order_details->quantity = $cart->quantity;
			$order_details->price = (int)$cart->price;
			$order_details->save();
		}

		Cart::where('member_id', $member_data->id)->delete();

        return redirect()->route('customer.order.details', $order->id)->with('success', 'Order submitted Successfully!');
	}

	public function view(){

		$user_id=Auth::user()->id;
		$data['orders'] = Order::where('user_id',$user_id)->get();
		$data['orderdetails'] = OrderDetails::all();
		return view('backend.home',$data);
    }

	public function checkout(Request $request){

		$data['member_data'] = session('member_data');

    	$data['cart_list'] = Cart::where('member_id', $data['member_data']->id)->get();

    	return view('frontend/checkout', $data);
    }
	
	public function order_list(Request $request){

		$data['member_data'] = session('member_data');

    	$data['cart_list'] = Order::where('member_id', $data['member_data']->id)->get();

    	return view('frontend/order', $data);
    }

	public function order_details($id, Request $request){

		$data['member_data'] = session('member_data');

    	$data['order'] = Order::where([
			'id' => $id,
			'member_id' => $data['member_data']->id
		])->first();

		if ( ! $data['order']) {
			return back()->with('error', $data);
		}

		$data['order_details'] = OrderDetails::where([
			'order_id' => $data['order']->id
		])->get();

    	return view('frontend/order_details', $data);
    }

	public function order_details_pdf($id, Request $request){

		// ini_set('max_execution_time', '600');

		$data['member_data'] = session('member_data');

    	$data['order'] = Order::where([
			'id' => $id,
			'member_id' => $data['member_data']->id
		])->first();

		if ( ! $data['order']) {
			return back()->with('error', $data);
		}

		$data['order_details'] = OrderDetails::where([
			'order_id' => $data['order']->id
		])->get();

		return view('frontend/order_details_pdf', $data);

		// $pdf = PDF::loadView('frontend/order_details_pdf', $data, [])->setPaper('a4', 'portrait');

		// return $pdf->stream('Item List Report. '.date('d-M-Y-').time().'.pdf');
    }

}


