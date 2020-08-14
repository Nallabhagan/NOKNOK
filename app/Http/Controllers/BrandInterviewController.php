<?php

namespace App\Http\Controllers;

use App\Brand;
use App\BrandInterview;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class BrandInterviewController extends Controller
{
    public function index(Brand $brand)
    {
        $questions = BrandInterview::orderBy('id','DESC')->select("*")->where(['brand_id' => $brand->id])->get();

    	return view('pages.brand', compact('brand','questions'));
    }

    public function ask_question(Request $request) 
    {
    	
    	$validatedData = $request->validate([
    	    'question' => 'required',
    	]);
    	if($validatedData) 
    	{
    		$data = BrandInterview::create([
	            'user_id' => Auth::id(),
	            'brand_id' => $request->brand_token,
	            'question' => $request->question,
	            'status' => "SAVED"
	        ]);
    	}
    	if($data) 
    	{
    		$brand_details = Brand::find($request->brand_token);
    		$details = [
    		    "notification_message" => "Asked a Question",
    		    "user_id" => Auth::id(),
    		    "interview_url" => url('brand').'/'.Hashids::connection('answer_slug')->encode(Auth::id()).'/'.$brand_details->slug
    		];
    		$notify_user = User::find($brand_details->brand_user_id);
            $notify_user->notify(new \App\Notifications\BrandQuestion($details));
            return redirect()->back();
    	}
    }

    public function answer(Request $request)
    {
        $validatedData = $request->validate([
            'answer' => 'required',
        ]);
        if($validatedData) 
        {
            $data = BrandInterview::where(["id" => $request->question_token])->update(["answer" => $request->answer]);
        }
        if($data) 
        {
            $brand_question_info = BrandInterview::select("brand_id","user_id")->where(["id" => $request->question_token])->first();

            $brand_details = Brand::find($brand_question_info['brand_id']);
            
            $details = [
                "notification_message" => "Answered your Question",
                "user_id" => $brand_details['brand_user_id'],
                "interview_url" => url('brand').'/'.Hashids::connection('answer_slug')->encode($brand_question_info['user_id']).'/'.$brand_details->slug
            ];
            $notify_user = User::find($brand_question_info['user_id']);
            $notify_user->notify(new \App\Notifications\BrandQuestion($details));
            return redirect()->back();
        }
        

    }

    public function single_user_question($user, $slug)
    {
        $brand = Brand::select('*')->where(["slug" => $slug])->first();
        $brand_id = $brand['id'];
        $user_id = Hashids::connection('answer_slug')->decode($user)[0];
        $questions = BrandInterview::orderBy("id","DESC")->select("*")->where(["brand_id" => $brand_id, "user_id" => $user_id])->get();
        return view('brand.single_user_questions', compact('brand','questions'));
    }
}
