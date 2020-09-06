<?php

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\InterviewComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class CommentsController extends Controller
{
    public function save_comment(Request $request)
    {

    	$interview_id = Hashids::connection('nokit')->decode($request->interview_token)[0];
    	$data = InterviewComment::create([
            'user_id' => Auth::id(),
            'interview_id' => $interview_id,
            'comment' => $request->comment
        ]);
    	
    }
}
