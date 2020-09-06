<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
    	return view('dashboard.profile.edit');
    }

    public function profile_pic(Request $request)
    {
    		
    	if($request->profile_pic != null)
    	{
    	    $rules = array(
    	      'profile_pic'  => 'required|image|max:2048'
    	    );

    	    $error = Validator::make($request->all(), $rules);

    	    if($error->fails())
    	    {
    	        return redirect()->back()->withErrors(['errors' => $error->errors()->all()]);
    	    }

    	    
    	    if(file_exists("assets/user_profile/".Auth::user()->profile_pic)) 
    	    {
    	        unlink("assets/user_profile/".Auth::user()->profile_pic);
    	    }
    	    $image = $request->file('profile_pic');
    	    $new_name = rand() . '.' . $image->getClientOriginalExtension();
    	   	$image->move(('assets/user_profile'), $new_name);

    	    $data = User::where(["id" => Auth::id()])->update(["profile_pic" => $new_name]);
    	   	if($data)
    	   	{
    	   		$request->session()->flash('message','Profile Pic Changed');
    	   		return redirect()->back();
    	   	}

    	}
    }

    public function profile_details(Request $request)
    {

    	$rules = array(
    	  'name'  => 'required'
    	);

    	$error = Validator::make($request->all(), $rules);

    	if($error->fails())
    	{
    	    return redirect()->back()->withErrors(['errors' => $error->errors()->all()]);
    	}
    	$data = User::where(["id" => Auth::id()])->update(["name" => $request->name, "mobile_no" => $request->mobile_number, "about" => $request->about]);
    	if($data)
    	{
    		$request->session()->flash('message','Profile Details Updated');
    		return redirect()->back();
    	}
    }

    public function social_links(Request $request)
    {

    	$data = User::where(["id" => Auth::id()])->update(["fb" => $request->fb, "twitter" => $request->twitter, "linkedin" => $request->linkedin, "insta" => $request->insta]);
    	if($data)
    	{
    		$request->session()->flash('message','Social Links Updated');
    		return redirect()->back();
    	}
    }
}
