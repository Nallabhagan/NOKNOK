<?php

namespace App\Http\Controllers;

use App\Brand;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BrandController extends Controller
{
   public function index() 
   {
        return view('pages.ask-a-question');
   }

    public function create_profile() 
    {
    	if(Auth::id() == 1) {
    		$users = User::orderBy('name','ASC')->select('id','name')->get();
    		return view('brand.new_brand.create', compact('users'));
    	} else {
    		return redirect('/');
    	}
    }

    public function store(Request $request) 
    {
    	
    	if($request->brand_thumbnail != null)
        {
            $rules = array(
              'brand_thumbnail'  => 'required|image|max:2048'
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return redirect()->back()->withErrors(['errors' => $error->errors()->all()]);
                // return response()->json(['errors' => $error->errors()->all()]);
            }

            $image = $request->file('brand_thumbnail');

            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(('assets/brand_thumbnails'), $new_name);
        }else{
            $new_name = "NULL";
        }

        $slug = Str::slug($request->brand_name);
        $data = Brand::create([
            'user_id' => Auth::id(),
            'brand_user_id' => $request->brand_user_id,
            'brand_name' => $request->brand_name,
            'description' => $request->brand_description,
            'slug' => $slug,
            'image' => $new_name,
            'status' => "LIVE"
        ]);

        if($data) {
        	$url = url('brand').'/'.$slug;
        	return redirect($url);
        }
    }
}
