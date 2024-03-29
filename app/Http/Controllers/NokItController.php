<?php

namespace App\Http\Controllers;

use App\NokIt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

class NokItController extends Controller
{
    public function save(Request $request)
    {
    	
    	$rules = array(
    	  'nokit_content'  => 'required'
    	);

    	$error = Validator::make($request->all(), $rules);

    	if($error->fails())
    	{
    	    return redirect()->back()->withErrors(['errors' => $error->errors()->all()]);
    	    // return response()->json(['errors' => $error->errors()->all()]);
    	}
    	$data = NokIt::create([
    	        'user_id' => Auth::id(),
    	        'content' => $request->nokit_content,
    	    ]);
    	if($data)
    	{
    		return redirect()->back();
    	}
    }
    
    public function delete(Request $request)
    {

        $nokit_id = Hashids::connection('nokit')->decode($request->nokit_token)[0];
        
        return $delete_post = NokIt::where(["id" => $nokit_id])->update(["status" => "DELETED"]);
    }
}
