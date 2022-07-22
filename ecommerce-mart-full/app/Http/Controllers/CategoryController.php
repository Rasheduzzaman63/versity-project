<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Image;

class CategoryController extends Controller
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

            $categories = Category::get();

			return Datatables::of($categories)

				->addIndexColumn()

                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    onclick="editCategory(event)" class="edit_btn btn btn-xs btn-info">
                                                    Edit
                                                </a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    data-url="'.url('categories/'.$row['id']).'"
                                                    class="btn btn-xs btn-danger delete-ajax">
                                                    Delete
                                                </a>';

                            return $btn;
                    })

                    ->rawColumns(['action'])

                    ->make(true);
        }

        return view('backend.categories.index', $data);
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
			
        ]);

        $requests = $request->all();

        

        
        

        $requests['authored_by'] = \Auth::user()->id;

        $Category = Category::create($requests);
        $id = $Category->id;

        $Category = Category::where("id", $id)->first();
		
        return response()->json(['status'=>'success', 'message'=>'Category Saved successfully!', 'Category'=>$Category], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Category = Category::find($id);

        return response()->json($Category);
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

        Category::find($id)->update($requests);

        $Category = Category::where("id", $id)->first();
		
        return response()->json(['status'=>'success', 'message'=>'Category Updated successfully!', 'Category'=>$Category], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $Category = Category::find($id)->delete();

      return response()->json(['status'=>'success', 'message'=>'Data Deleted successfully'], 200);
    }
}
