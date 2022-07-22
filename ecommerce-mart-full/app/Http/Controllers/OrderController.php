<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Image;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $data["members"] = \App\Models\Member::select("id", "name")->get();
		$data["payments"] = \App\Models\Payment::select("id", "trx_num")->get();
		

        if ($request->ajax()) {

            $model = Order::with('payments_relation')->with('members_relation');
			return DataTables::eloquent($model)
				->addIndexColumn()
				->addColumn('members_relation', function (Order $Order) {
					// belongsTo (one)
					return $Order->members_relation->name ?? '';
					// use map for // belongsToMany
				})
				->addColumn('payments_relation', function (Order $Order) {
					// belongsTo (one)
					return $Order->payments_relation->trx_num ?? '';
					// use map for // belongsToMany
				})

                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    onclick="editOrder(event)" class="edit_btn btn btn-xs btn-info">
                                                    Edit
                                                </a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    data-url="'.url('orders/'.$row['id']).'"
                                                    class="btn btn-xs btn-danger delete-ajax">
                                                    Delete
                                                </a>';

                            return $btn;
                    })

                    ->rawColumns(['action'])

                    ->make(true);
        }

        return view('backend.orders.index', $data);
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
            'member_id' => 'required',
			'payment_id' => 'required',
			'order_no' => 'required',
			'order_total' => 'required',
			'shipping_date' => 'required',
			'address' => 'required',
			'status' => 'required',
			
        ]);

        $requests = $request->all();

        

        $requests["shipping_date"] = date("Y-m-d", strtotime($requests["shipping_date"]));
		
        

        $requests['authored_by'] = \Auth::user()->id;

        $Order = Order::create($requests);
        $id = $Order->id;

        $Order = Order::where("id", $id)->with("members_relation")->with("payments_relation")->first();
		
        return response()->json(['status'=>'success', 'message'=>'Order Saved successfully!', 'Order'=>$Order], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Order = Order::find($id);

        return response()->json($Order);
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
            'member_id' => 'required',
			'payment_id' => 'required',
			'order_no' => 'required',
			'order_total' => 'required',
			'shipping_date' => 'required',
			'address' => 'required',
			'status' => 'required',
			
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
        $requests["shipping_date"] = date("Y-m-d", strtotime($requests["shipping_date"]));
		

        // checkbox not updated on null requested
        
        

        $requests['authored_by'] = \Auth::user()->id;

        Order::find($id)->update($requests);

        $Order = Order::where("id", $id)->with("members_relation")->with("payments_relation")->first();
		
        return response()->json(['status'=>'success', 'message'=>'Order Updated successfully!', 'Order'=>$Order], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $Order = Order::find($id)->delete();

      return response()->json(['status'=>'success', 'message'=>'Data Deleted successfully'], 200);
    }
}
