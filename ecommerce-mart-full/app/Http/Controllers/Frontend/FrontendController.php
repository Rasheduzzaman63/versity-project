<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\User;
use App\Models\Color;
use App\Models\Size;
use App\Models\Category;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Shipping;
use App\Models\ProductSubImage;
use App\Models\Slider;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;
use Illuminate\Http\Request;

class frontendController extends Controller
{
	public function productsView(Request $request){

		$data['catData'] = Product::orderBy('id','desc')->paginate(20);
		$data['categories'] = Product::select('category_id')->groupBy('category_id')->get();

		return view('frontend.product.view-product', $data);
	}
	
    public function productDetails($id){

		$data['product'] = Product::find($id);

		return view('frontend.product.product-details',$data);		
	}

	public function search_products(Request $request)
    {
		$data['products'] = [];
		if ( $request['query'] == '') {
			return response()->json(['status'=>'success', 'data'=> $data['products'] ]);
		}

        $products = DB::table('products');
        
        if ($request['query']) {

            $where = "name like '%".$request['query']."%'";

            $products = $products->whereRaw($where);
        }

        $data['products'] = $products->limit(12)->orderBy('id', 'desc')->get();

        return response()->json(['status'=>'success', 'data'=> $data['products'] ]);
    }

	public function CategoryMenu( $category_id){

		$data['catData'] = Product::where('category_id', $category_id)->orderBy('id','desc')->get();
		$data['category'] = Category::find($category_id);
        //optional 
		$data['shipid']= session()->get('ship');

		return view('frontend.product.category-wise-product', $data);
	}

	public function viewProfile(){
		$data['profile'] = User::where('id',Auth::user()->id)->first();
		return view('frontend.profile.view-profile',$data);
	}

	public function editProfile($id){
		$data['editProfile'] = User::find(Auth::user()->id);
		

		return view('frontend.profile.edit-profile',$data);
	}

	public function updateProfile(Request $request){
		$this-> validate($request,[
    	
    	'UserName' => 'required',
    	'phone' => 'required',
    	'postal' => 'required',
    	'city' => 'required',
    	'addr' => 'required',
    	'gender' => 'required',
    	]);

    	$data = User::find(Auth::user()->id);
    	$data->UserName = 		$request->UserName;
    	$data->phone = 			$request->phone;
    	$data->postal = 		$request->postal;
    	$data->city = 			$request->city;
    	$data->addr = 			$request->addr;
    	$data->gender = 		$request->gender;
    	$img = $request->file('image');
    	if($img){
    		$imgName = $img->getClientOriginalName();
    		$img->move('backend/upload/user/',$imgName);
    		$data['image'] = $imgName;
    	}
    	$data-> save();
    	return redirect('my/view-profile') ->with('alert','Data Updated Successfully');
    }

    public function changePass(){
    $data['profile'] = User::where('id',Auth::user()->id)->first();
    	return view('frontend.profile.password-change',$data);
    }

    public function updatePass(Request $request){
    	if(Auth::attempt(['id' => Auth::user()->id,'password'=>$request->crnt_pass])){
	    	$user = User::find(Auth::user()->id);
	    	$user->password = bcrypt($request->new_pass);
	    	$user->save();
	    	return redirect('my/view-profile') ->with('alert','Password Updated Successfully');
	    }
	    else{
	    	return redirect()->back()->with('alert',"Current Password Dosen't match");
	    }
    }

	public function index(){
		return view('frontend.layouts.index');
	}

	public function about(){
		return view('frontend.pages.about');
		
	}
	public function contact(){
		return view('frontend.pages.contact');
		
	}
	
}
