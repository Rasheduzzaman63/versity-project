<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Image;
class MemberController extends Controller
{
    public function login(Request $request){

        // $wanted_uri = isset($_COOKIE['wanted']) ? $_COOKIE['wanted'] : 'member/dashboard';

        if($request->session()->get('member_logged') == true){
            return redirect()->intended();
            // return redirect($wanted_uri);
        }
    	return view('auth-member/login');
    }

    public function register(Request $request){

        if($request->session()->get('member_logged') == true){
            return redirect()->intended();
        }
        return view('auth-member/register');
    }

    public function loginValidate(Request $request){

    	$member = Member::where('email', $request->email)->first();

        if($member){
            $checkPass = Hash::check($request->password, $member->password);             
        }else{
            $checkPass = false;
        }

    	if($member && $checkPass){
    		$request->session()->put('member_logged', true);
    		$request->session()->put('member_data', $member);

            if ($request->previous_uri) {
                return redirect($request->previous_uri);
            }else{
                return back();
            }

            // $wanted_uri = isset($_COOKIE['wanted']) ? $_COOKIE['wanted'] : 'member/dashboard';
            // return redirect($wanted_uri);

    	}else{
            return back()->withInput()->with(['error'=>'Invalid Login Information']);
    	}
    }

    public function registration(Request $request)
    {
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'phone' => ['required', 'string', 'max:255', 'unique:members'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
        //     'password' => ['required', 'string', 'min:6', 'confirmed'],
        // ]);
        if (strlen($request->password) < 6) {
            return back()->with(['from'=>'register', 'error'=>'Password should be at least 6 characters!'])->withInput();
        }

        if ($request->name == '' || $request->phone == '' || $request->email == '' ) {
            return back()->with(['from'=>'register', 'error'=>'Name, phone & email are required!'])->withInput();
        }        

        $member = Member::where('email', $request->email)->first();
        if ($member) {
            return back()->with(['from'=>'register', 'error'=>'E-mail already exists!'])->withInput();
        }

        $member = Member::where('phone', $request->phone)->first();
        if ($member) {
            return back()->with(['from'=>'register', 'error'=>'Phone already exists!'])->withInput();
        }

        $image_save = "";

        if(request()->hasFile('image')){
            $originalImage= $request->file('image');
            $img = Image::make($originalImage);

            $imgOriginalName = $originalImage->getClientOriginalName();
            //first 10 characters
            $imgOriginalName = substr( explode('.', $imgOriginalName)[0], 0, 10) ;

            $imgOriginalName = preg_replace('/[^A-Za-z0-9\-]/', '', $imgOriginalName) .'-'.time();
            $imgOriginalName .= '.'.$originalImage->getClientOriginalExtension();

            $originalPath = public_path().'/upload/member-profiles/';
            $img->resize(300, 250);
            // insert a watermark
            // $img->insert('public/watermark.png');
            $img->save($originalPath. $imgOriginalName);

            $image_save = 'upload/member-profiles/'.$imgOriginalName;
        }

        Member::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'image' => $image_save,
        ]);

        $member = Member::where('email', $request->email)->first();

        $request->session()->put('member_logged', true);
        $request->session()->put('member_data', $member);
        
        return back()->with(['success'=>'Registration successful!']);
    }

    public function forgotPassword(Request $request){

        if($request->isMethod('post')){

            $existMember = Member::where('email', $request->email)->first();

            if ( ! $existMember) {
                return redirect()->back()->with('error', 'E-mail ' .$request->email.' is not found to our database!' );
            }

            try{

                // $radomPassword = rand(100000, 999999);
                // $updateData['password'] = bcrypt($radomPassword);

                $updateData = ['extra_remember_token' => Str::random(10)];
                $existMember->update($updateData);

                $message_text = "Dear user, \n\n";
                $message_text .= "You have requested to reset password at ecommerce. \n";
                $message_text .= "Please click the link below or copy and paste to new tab url:, \n";
                $message_text .= url("/")."/password-reset/".$updateData['extra_remember_token']."\n Please click the link below or copy and paste to new tab url:, \n\n";
                $message_text .= "Thank you.\n";

                $email = $request->email;

                // Mail::raw($message_text, function ($message) use($email) {

                //     $message->to($email)->subject('Password Reset Link Request.');
                // });

                // return redirect()->back()->with('success', 'A password reset link has sent to your email '.$request->email.' .<br />Please check your email inbox or spam folder.');

                return redirect()->back()->with('success', $message_text.'A password reset link has sent to your email '.$request->email.' .<br />Please check your email inbox or spam folder.');

            }catch(\Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return view('frontend.forgot-password');
    }

    public function index(Request $request){
        $data['member'] = Member::find($request->session()->get('logged_member_id'));
        return view('frontend.member.dashboard', $data);
    }

    public function changePassword(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'password'  => 'required|confirmed'
            ]);

            $updateData['password'] = bcrypt($request->password);

            $member = Member::find($request->session()->get('logged_member_id'));
            $member->update($updateData);
            return redirect()->route('frontend.member.change-password')->with('success', 'Password has been changed successfully!');

        }
        return view('frontend.member.change-password');
    }


    public function logout(Request $request){

        // delete single data
    	// $request->session()->forget('member_logged');

        // delete all session data
    	$request->session()->flush();
        
    	return redirect('/');
    }

    public function passwordReset(Request $request, $extra_remember_token){

        $existMember = Member::where('extra_remember_token', $extra_remember_token)->first();


        if($request->isMethod('post')){
            
            if ( ! $existMember || ! $extra_remember_token) {
                return redirect()->back()->with('error', 'Invalid token for reset password!' );
            }

            if ( $request->password != $request->password_confirmation) {
                return redirect()->back()->with('error', 'Confirmation password not match!' );
            }            

            try{

                $updateData['password'] = bcrypt($request->password);
                $updateData['extra_remember_token'] = '';

                $existMember->update($updateData);

                $message_text = "Dear user, \n\n";
                $message_text .= "Your new password was set successfully. \n";
                $message_text .= "Thank you for being with us.\n";

                $email = $request->email;

                // Mail::raw($message_text, function ($message) use($email) {

                //     $message->to($email)->subject('New Password Set Successfull.');
                // });

                return redirect()->route('member.login')->with('success', 'Your new password was set successfully.');

            }catch(\Exception $e){

                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        if ( ! $existMember || ! $extra_remember_token) {

            return redirect('/')->with('error', 'Invalid token for reset password!');
        }

        return view('frontend.reset-password')->with('extra_remember_token', $extra_remember_token);
    }

    public function profile()
    {
        $logged_member = Member::find(request()->session()->get('member_data')->id);
        
        return view('frontend.member.edit', compact('logged_member'));
    }

    public function profile_update(Request $request)
    {
        $logged_member = Member::find(request()->session()->get('member_data')->id);
        
        if (request()->password) {
            $rules = [
                'name' => 'required',
                // 'phone' => 'required',
                // 'email' => 'required|email|unique:members,email,'.$member->id,
                'password' => 'min:6|confirmed',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }else{
            $rules = [
                'name' => 'required',
                // 'email' => 'required|email|unique:members,email,'.$member->id,
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }

        $this->validate(request(), $rules);

        if(request()->hasFile('image')){
            $originalImage= $request->file('image');
            $img = Image::make($originalImage);

            $imgOriginalName = $originalImage->getClientOriginalName();
            //first 10 characters
            $imgOriginalName = substr( explode('.', $imgOriginalName)[0], 0, 10) ;

            $imgOriginalName = preg_replace('/[^A-Za-z0-9\-]/', '', $imgOriginalName) .'-'.time();
            $imgOriginalName .= '.'.$originalImage->getClientOriginalExtension();

            $originalPath = public_path().'/upload/member-profiles/';
            $img->resize(300, 250);
            // insert a watermark
            // $img->insert('public/watermark.png');
            $img->save($originalPath. $imgOriginalName);

            $img->resize(100, 100);
            $thumbnailPath = public_path().'/upload/member-profiles-thumb/';
            // insert a watermark
            // $img->insert('public/watermark.png');
            $img->save($thumbnailPath. $imgOriginalName); 

            $logged_member->image = 'upload/member-profiles/'.$imgOriginalName;
        }

        $logged_member->name = request('name');
        $logged_member->phone = request('phone');
        $logged_member->address = request('address');

        $request->session()->put('member_data', $logged_member);

        if (request()->password) {
            $logged_member->password = bcrypt(request('password'));
        }

        $logged_member->save();

        return redirect()->back()->with('success', 'Updated Successfully!');
    }


}
