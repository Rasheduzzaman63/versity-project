<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use DB;
use Yajra\DataTables\Facades\DataTables;
use Image;

class SliderController extends Controller
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

            $sliders = Slider::get();

			return Datatables::of($sliders)

				->addIndexColumn()

                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    onclick="editSlider(event)" class="edit_btn btn btn-xs btn-info">
                                                    Edit
                                                </a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    data-url="'.url('sliders/'.$row['id']).'"
                                                    class="btn btn-xs btn-danger delete-ajax">
                                                    Delete
                                                </a>';

                            return $btn;
                    })

                    ->rawColumns(['action'])

                    ->make(true);
        }

        return view('backend.sliders.index', $data);
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
            'slider_image' => 'required',
			'title' => 'required',
			
        ]);

        $requests = $request->all();

        

        
        if(request()->hasFile("slider_image")){
			$image = request()->file("slider_image");
			$extension = $image->getClientOriginalExtension();
			$uploadDir = "/upload/sliders/";
			$destinationPath = public_path($uploadDir);
			if(!is_dir($destinationPath)){
				mkdir($destinationPath);
			}
			$img_name = "slider_image-".time().".".$extension;
			$img = Image::make($image->getRealPath());
			$img->resize(768, 432)->save($destinationPath."/". $img_name);
			$requests["slider_image"] = $uploadDir . $img_name;
		}


        $requests['authored_by'] = \Auth::user()->id;

        $Slider = Slider::create($requests);
        $id = $Slider->id;

        $Slider = Slider::where("id", $id)->first();
		
        return response()->json(['status'=>'success', 'message'=>'Slider Saved successfully!', 'Slider'=>$Slider], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Slider = Slider::find($id);

        return response()->json($Slider);
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
            'slider_image' => 'required',
			'title' => 'required',
			
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
        
        if(request()->hasFile("slider_image")){
			$image = request()->file("slider_image");
			$extension = $image->getClientOriginalExtension();
			$uploadDir = "/upload/sliders/";
			$destinationPath = public_path($uploadDir);
			if(!is_dir($destinationPath)){
				mkdir($destinationPath);
			}
			$img_name = "slider_image-".time().".".$extension;
			$img = Image::make($image->getRealPath());
			$img->resize(768, 432)->save($destinationPath."/". $img_name);
			$requests["slider_image"] = $uploadDir . $img_name;
		}


        $requests['authored_by'] = \Auth::user()->id;

        Slider::find($id)->update($requests);

        $Slider = Slider::where("id", $id)->first();
		
        return response()->json(['status'=>'success', 'message'=>'Slider Updated successfully!', 'Slider'=>$Slider], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $Slider = Slider::find($id)->delete();

      return response()->json(['status'=>'success', 'message'=>'Data Deleted successfully'], 200);
    }
}
