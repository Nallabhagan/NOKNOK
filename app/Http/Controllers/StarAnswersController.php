<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StarAnswer;

class StarAnswersController extends Controller
{
    public function put_star(Request $request) 
    {
    	$star_answer = new StarAnswer; 
    	$star_answer->interview_id = $request->interview_id;
    	$star_answer->answer_index = $request->answer_index;
    	return($star_answer->save());
    }

    public function remove_star(Request $request) 
    {
    	$remove = StarAnswer::where(['interview_id'=>$request->interview_id,'answer_index'=>$request->answer_index])->delete();
    	return $remove;
    }
}
