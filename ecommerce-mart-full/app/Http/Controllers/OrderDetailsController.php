<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetails;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Image;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $data["orders"] = \App\Models\Order::select("id", "order_no")->get();
		$data["products"] = \App\Models\Product::select("id", "name")->get();
		

        if ($request->ajax()) {

            $model = OrderDetails::with('products_relation')->with('orders_relation');
			return DataTables::eloquent($model)
				->addIndexColumn()
				->addColumn('orders_relation', function (OrderDetails $Order_Details) {
					// belongsTo (one)
					return $Order_Details->orders_relation->order_no ?? '';
					// use map for // belongsToMany
				})
				->addColumn('products_relation', function (OrderDetails $Order_Details) {
					// belongsTo (one)
					return $Order_Details->products_relation->name ?? '';
					// use map for // belongsToMany
				})

                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    onclick="editOrderDetails(event)" class="edit_btn btn btn-xs btn-info">
                                                    Edit
                                                </a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    data-url="'.url('order_details/'.$row['id']).'"
                                                    class="btn btn-xs btn-danger delete-ajax">
                                                    Delete
                                                </a>';

                            return $btn;
                    })

                    ->rawColumns(['action'])

                    ->make(true);
        }

        return view('backend.order_details.index', $data);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
			'product_id' => 'required',
			'product_name' => 'required',
			'quantity' => 'required',
			'price' => 'required',
			
        ]);

        $requests = $request->all();

        

        
        if(request()->hasFile("product_image")){
			$image = request()->file("product_image");
			$extension = $image->getClientOriginalExtension();
			$uploadDir = "/upload/order_details/";
			$destinationPath = public_path($uploadDir);
			if(!is_dir($destinationPath)){
				mkdir($destinationPath);
			}
			$img_name = "product_image-".time().".".$extension;
			$img = Image::make($image->getRealPath());
			$img->resize(768, 432)->save($destinationPath."/". $img_name);
			$requests["product_image"] = $uploadDir . $img_name;
		}


        $requests['authored_by'] = \Auth::user()->id;

        $Order_Details = OrderDetails::create($requests);
        $id = $Order_Details->id;

        $Order_Details = OrderDetails::where("id", $id)->with("orders_relation")->with("products_relation")->first();
		
        return response()->json(['status'=>'success', 'message'=>'OrderDetails Saved successfully!', 'Order_Details'=>$Order_Details], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Order_Details = OrderDetails::find($id);

        return response()->json($Order_Details);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required',
			'product_id' => 'required',
			'product_name' => 'required',
			'quantity' => 'required',
			'price' => 'required',
			
        ]);

        $requests = $request->all();

        foreach ($requests as $key => $value) {
            // for multiple values array like checkbox
            if(is_array($value)){
                // convert to json string
                $requests[$key] = json_encode($value);
            }
        }

        // for date input filter
        

        // checkbox not updated on null requested
        
        if(request()->hasFile("product_image")){
			$image = request()->file("product_image");
			$extension = $image->getClientOriginalExtension();
			$uploadDir = "/upload/order_details/";
			$destinationPath = public_path($uploadDir);
			if(!is_dir($destinationPath)){
				mkdir($destinationPath);
			}
			$img_name = "product_image-".time().".".$extension;
			$img = Image::make($image->getRealPath());
			$img->resize(768, 432)->save($destinationPath."/". $img_name);
			$requests["product_image"] = $uploadDir . $img_name;
		}


        $requests['authored_by'] = \Auth::user()->id;

        OrderDetails::find($id)->update($requests);

        $Order_Details = OrderDetails::where("id", $id)->with("orders_relation")->with("products_relation")->first();
		
        return response()->json(['status'=>'success', 'message'=>'OrderDetails Updated successfully!', 'Order_Details'=>$Order_Details], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $Order_Details = OrderDetails::find($id)->delete();

      return response()->json(['status'=>'success', 'message'=>'Data Deleted successfully'], 200);
    }
}
