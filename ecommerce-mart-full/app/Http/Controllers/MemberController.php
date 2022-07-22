<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Image;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        

        if ($request->ajax()) {

            $members = Member::get();

			return Datatables::of($members)

				->addIndexColumn()

                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    onclick="editMember(event)" class="edit_btn btn btn-xs btn-info">
                                                    Edit
                                                </a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    data-url="'.url('members/'.$row['id']).'"
                                                    class="btn btn-xs btn-danger delete-ajax">
                                                    Delete
                                                </a>';

                            return $btn;
                    })

                    ->rawColumns(['action'])

                    ->make(true);
        }

        return view('backend.members.index', $data);
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
            'name' => 'required',
			'password' => 'required',
			'address' => 'required',
			'status' => 'required',
			
        ]);

        $requests = $request->all();

        

        
        if(request()->hasFile("image")){
			$image = request()->file("image");
			$extension = $image->getClientOriginalExtension();
			$uploadDir = "/upload/members/";
			$destinationPath = public_path($uploadDir);
			if(!is_dir($destinationPath)){
				mkdir($destinationPath);
			}
			$img_name = "image-".time().".".$extension;
			$img = Image::make($image->getRealPath());
			$img->resize(768, 432)->save($destinationPath."/". $img_name);
			$requests["image"] = $uploadDir . $img_name;
		}


        $requests['authored_by'] = \Auth::user()->id;

        $Member = Member::create($requests);
        $id = $Member->id;

        $Member = Member::where("id", $id)->first();
		
        return response()->json(['status'=>'success', 'message'=>'Member Saved successfully!', 'Member'=>$Member], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Member = Member::find($id);

        return response()->json($Member);
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
            'name' => 'required',
			'password' => 'required',
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
        

        // checkbox not updated on null requested
        
        if(request()->hasFile("image")){
			$image = request()->file("image");
			$extension = $image->getClientOriginalExtension();
			$uploadDir = "/upload/members/";
			$destinationPath = public_path($uploadDir);
			if(!is_dir($destinationPath)){
				mkdir($destinationPath);
			}
			$img_name = "image-".time().".".$extension;
			$img = Image::make($image->getRealPath());
			$img->resize(768, 432)->save($destinationPath."/". $img_name);
			$requests["image"] = $uploadDir . $img_name;
		}


        $requests['authored_by'] = \Auth::user()->id;

        Member::find($id)->update($requests);

        $Member = Member::where("id", $id)->first();
		
        return response()->json(['status'=>'success', 'message'=>'Member Updated successfully!', 'Member'=>$Member], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $Member = Member::find($id)->delete();

      return response()->json(['status'=>'success', 'message'=>'Data Deleted successfully'], 200);
    }
}
