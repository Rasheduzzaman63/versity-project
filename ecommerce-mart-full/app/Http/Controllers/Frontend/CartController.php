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
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Cart;
use App\Models\Shipping;
use App\Models\ShipIdPass;
use App\Http\Requests\ProductRequest;
use DB;
use Auth;
use session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function view(Request $request){

        $data['cart_list'] = Cart::where('member_id', session('member_data')->id)->get();

        return view('frontend.cart.view', $data);
    }

    public function store(Request $request){

    	$this->validate($request,[
    		'product_id.*' => 'required',
    		'product_qty.*' =>  'required|digits_between:1,100000',
    	]);

        $store = [];

        if ( ! $request->product_id) {

            return redirect()->route('/')->with('error', 'Please add product to cart for checkout!');
        }

        foreach($request->product_id as $key => $value){

            $product = Product::find( $value);

            $store[$key]['member_id'] = session('member_data')->id;
            $store[$key]['product_id'] = $product->id;
            $store[$key]['product_name'] = $product->name;
            $store[$key]['product_image'] = $product->image;
            $store[$key]['quantity'] = $request->product_qty[$key];
            $store[$key]['price'] = $product->price * $request->product_qty[$key];

            $cart = Cart::where([
                'member_id' => session('member_data')->id,
                'product_id' => $product->id,
            ])->first();

            if ($cart) {

                $cart->update(
                    $store[$key]
                );

            }else{
                Cart::create($store[$key]);
            }
        }

        if($request->checkout==1){

            return redirect()->route('customer.checkout');
        }else{

            return redirect()->back()->with('success', 'Products added to cart success.');
        }
    }

    public function productStore(Request $request, $product_id)
    {
        if ( ! $product_id) {
            return redirect()->back()->with('error', 'Product id missing!');
        }

        $product = Product::find( $product_id);

        if (! $product) {
            return redirect()->back()->with('error', 'Invalid Product.');
        }

        $store= [];

        $store['member_id'] = session('member_data')->id;
        $store['product_id'] = $product->id;
        $store['product_name'] = $product->name;
        $store['product_image'] = $product->image;
        $store['quantity'] = 1;
        $store['price'] = $product->price;

        $cart = Cart::where([
            'member_id' => session('member_data')->id,
            'product_id' => $product->id,
        ])->first();

        if ($cart) {
            $qty = $cart->quantity + 1;
            $store['quantity'] = $qty;
            $store['price'] = $product->price * $qty;
            $cart->update($store);
        }else{
            Cart::create($store);
        }

        return redirect()->route('customer.cart.create')->with('success', 'Product added to cart success.');
    }

    public function delete($id){

        $data = Cart::where([
            'member_id' => session('member_data')->id,
            'id' => $id
        ]);

        $data->delete();

        return redirect()->back();
    }

    public function additem(Request $request){
    	$ting  = $request-> shipid;
    	return redirect('my/products/view');
    }

    
    public function alldelete($id){
        DB::delete('delete from carts where shipping_id = ?',[$id]);
        return redirect()->back()->with('alert','Data Delete Successfully');
    }

    public function session_set(Request $request){

        session()->put('ship',$request->shipping_id);
        return redirect()->back();
    }

    public function session_shipping(Request $request){
        session()->put('ship',$request->shipid);
        return redirect('my/products/view');
    }
}
