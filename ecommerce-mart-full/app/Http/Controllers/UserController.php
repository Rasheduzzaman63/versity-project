<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Image;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $model = User::latest();

        if ($request->ajax()) {

			return DataTables::eloquent($model)
				->addIndexColumn()

                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    onclick="editUser(event)" class="edit_btn btn btn-xs btn-info">
                                                    Edit
                                                </a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row['id'].'"
                                                    data-url="'.url('users/'.$row['id']).'"
                                                    class="btn btn-xs btn-danger delete-ajax">
                                                    Delete
                                                </a>';

                            return $btn;
                    })

                    ->rawColumns(['action'])

                    ->make(true);
        }

        return view('users.index', $data);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // rule sometimes works only on field name is no present
        $request->validate([
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'status' => 'required',
			'password' => [
                    'required',
                    'confirmed',
                    'min:8',             // must be at least 8 characters in length
                ],
        ]);

        $requests = $request->all();
        $requests['password'] = Hash::make($requests['password']);

        foreach ($requests as $key => $value) {
            // for multiple values array like checkbox
            if(is_array($value)){
                // convert to json string
                $requests[$key] = json_encode($value);
            }
        }

        if(request()->hasFile('image')){
            $image = request()->file('image');
            $extension = $image->getClientOriginalExtension();
            $uploadDir = '/upload/profiles/';
            $destinationPath = public_path($uploadDir);
            $img_name = 'User-'.time().'.'.$extension;
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200)->save($destinationPath.'/'. $img_name );
            $requests['image'] = $uploadDir . $img_name;
        }

        $requests['authored_by'] = \Auth::user()->id;

        $user = User::create($requests);
        $id = $user->id;
		
        return response()->json(['status'=>'success', 'message'=>'User Saved successfully!', 'user'=>$user], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return response()->json($user);
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
        if (Auth::user()->type=='superadmin' && $request->type=='superadmin') {
            // if superadmin updates himself
            // rule sometimes works only on field name is no present
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'password' => [
                    'nullable',
                    'confirmed',
                    'min:8',             // must be at least 8 characters in length
                ],
            ]);
        }else{
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'status' => 'required',
                'password' => [
                    'nullable',
                    'confirmed',
                    'min:8',             // must be at least 8 characters in length
                ],
            ]);
        }

        $requests = $request->all();

        if($requests['password']==''){
            unset($requests['password']);
        }else{
            $requests['password'] = Hash::make($requests['password']);
        }

        foreach ($requests as $key => $value) {
            // for multiple values array like checkbox
            if(is_array($value)){
                // convert to json string
                $requests[$key] = json_encode($value);
            }
        }

        if(request()->hasFile('image')){
            $image = request()->file('image');
            $extension = $image->getClientOriginalExtension();
            $uploadDir = '/upload/profiles/';
            $destinationPath = public_path($uploadDir);
            $img_name = 'User-'.time().'.'.$extension;
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200)->save($destinationPath.'/'. $img_name );
            $requests['image'] = $uploadDir . $img_name;
        }
        
        // checkbox not updated on null requested

        $requests['authored_by'] = \Auth::user()->id;

        $user = User::find($id)->update($requests);
		
        return response()->json(['status'=>'success', 'message'=>'User Updated successfully!', 'user'=>$user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id)->delete();

      return response()->json(['status'=>'success', 'message'=>'Data Deleted successfully'], 200);
    }

    public function my_profile()
    {
        $data = [];

        return view('users.edit', $data);
    }

}
