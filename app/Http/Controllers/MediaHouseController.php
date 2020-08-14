<?php

namespace App\Http\Controllers;

use App\MediaHouse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

class MediaHouseController extends Controller
{
    public function create(Request $request)
    {
    	try {
            $rules = array(
              'media_name'  => 'required',
              'about_media_house' => 'required'
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return redirect()->back()->withErrors(['errors' => $error->errors()->all()]);
                // return response()->json(['errors' => $error->errors()->all()]);
            }

            $data = MediaHouse::create([
	            'user_id' => Auth::id(),
	            'name' => $request->media_name,
	            'description' => $request->about_media_house
	        ]);

	        if($data)
	        {
	        	$update_user = User::where(['id' => Auth::id()])->update(['media_house' => $data->id]);
	        	if($update_user)
	        	{
	        		return redirect()->back();
	        	}
	        }
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return redirect()->back()->withErrors(['errors' => "Media House Name Already Taken"]);
            }
        }
    }

    public function update(Request $request)
    {
        try {
            $media_id = Hashids::connection('user')->decode($request->media_token)[0];
            $rules = array(
              'media_name'  => 'required',
              'about_media_house' => 'required',
              'media_token' => 'required'
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return redirect()->back()->withErrors(['errors' => $error->errors()->all()]);
                // return response()->json(['errors' => $error->errors()->all()]);
            }

            
            $update_media = MediaHouse::where(['id' => $media_id])->update(['name' => $request->media_name, 'description' => $request->about_media_house, 'updated_at' => Carbon::now()]);
            if($update_media)
            {
                return redirect()->back();
            }

            
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return redirect()->back()->withErrors(['errors' => "Media House Name Already Taken"]);
            }
        }
    }
}
