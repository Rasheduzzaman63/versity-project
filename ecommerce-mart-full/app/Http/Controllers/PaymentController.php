<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Image;

class PaymentController extends Controller
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
		

        if ($request->ajax()) {

            $model = Payment::with('members_relation');
			return DataTables::eloquent($model)
				->addIndexColumn()
				->addColumn('members_relation', function (Payment $Payment) {
					// belongsTo (one)
					return $Payment->members_relation->name ?? '';
					// use map for // belongsToMany
				})

                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    onclick="editPayment(event)" class="edit_btn btn btn-xs btn-info">
                                                    Edit
                                                </a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    data-url="'.url('payments/'.$row['id']).'"
                                                    class="btn btn-xs btn-danger delete-ajax">
                                                    Delete
                                                </a>';

                            return $btn;
                    })

                    ->rawColumns(['action'])

                    ->make(true);
        }

        return view('backend.payments.index', $data);
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
            'payment_method' => 'required',
			'trx_num' => 'required',
			'member_id' => 'required',
			
        ]);

        $requests = $request->all();

        

        
        

        $requests['authored_by'] = \Auth::user()->id;

        $Payment = Payment::create($requests);
        $id = $Payment->id;

        $Payment = Payment::where("id", $id)->with("members_relation")->first();
		
        return response()->json(['status'=>'success', 'message'=>'Payment Saved successfully!', 'Payment'=>$Payment], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Payment = Payment::find($id);

        return response()->json($Payment);
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
            'payment_method' => 'required',
			'trx_num' => 'required',
			'member_id' => 'required',
			
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
        
        

        $requests['authored_by'] = \Auth::user()->id;

        Payment::find($id)->update($requests);

        $Payment = Payment::where("id", $id)->with("members_relation")->first();
		
        return response()->json(['status'=>'success', 'message'=>'Payment Updated successfully!', 'Payment'=>$Payment], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $Payment = Payment::find($id)->delete();

      return response()->json(['status'=>'success', 'message'=>'Data Deleted successfully'], 200);
    }
}
