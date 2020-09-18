<?php

namespace App\Http\Controllers;

use App\Question;
use App\Interview;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;


class InterviewController extends Controller
{
	
    //display interview Form with questions
    public function show_interview_questions(Question $interview) {
        
        if(Auth::check()) {
            //to check already answered
            $user = Interview::where(['user_id' => Auth::id(), 'question_id' => $interview->id])->first();

            if($interview->user_id == Auth::id()) { 
                $interview = Question::select('*')->where(["id" =>$interview->id])->first();
                return view('interviews.user_interview_pages.interview_creater',compact('interview'));
            } else if($user == null){
                
                return view('interviews.questions.interview_question',compact('interview'));
            } else {
                $url = url('interview')."/".Hashids::connection('answer_slug')->encode(Auth::id())."/".$interview->slug;
                return redirect($url);
            }
        } else {
            return view('interviews.questions.interview_question',compact('interview'));
        }
    }

    //to save answers
    public function save_interview(Request $request) {

        if(in_array(null, $request->answers, true)) {
            Session::flash('error', "Submit All the Answers");
            return response()->json([
                'error' => true,
            ]);
        } else {
            $question_id = Hashids::connection('create_question')->decode($request->question_token)[0];
            $question_info = Question::find($question_id);
            

            $slug = Str::slug($request->title);
            $data = Interview::create([
                    'user_id' => Auth::id(),
                    'question_id' => $question_id,
                    'answers' => $request->answers,
                    'slug' => $slug,
                    'status' => "PUBLISHED"
                ]);
            if($data) {
                $details = [
                    "notification_message" => "Answered ".$question_info->title." Interview",
                    "user_id" => Auth::id(),
                    "interview_url" => url('interview')."/".Hashids::connection('answer_slug')->encode(Auth::id())."/".$question_info->slug
                ];

                $notify_user = User::find($question_info->user_id);
                $notify_user->notify(new \App\Notifications\InterviewAnswered($details));


                $url = url('interview')."/".Hashids::connection('answer_slug')->encode(Auth::id())."/".$question_info->slug."?answered=true";
                return response()->json([
                    'message' => true,
                    'url' => $url
                ]);
            }
        }
    }

    //to display full interview
    //questions + answers = full Interview
    public function show_full_interview($user, $slug, Request $request) {

        $user_id = Hashids::connection('answer_slug')->decode($user)[0];
        $interview = Interview::select('id', 'question_id', 'user_id', 'answers', 'created_at')->where(['user_id' => $user_id, 'slug' => $slug])->first();


        if($request->has('answered')) {
            // return $interview;
            return view('interviews.user_interview_pages.interview_published',compact('interview'));
        } else {
            return view('interviews.user_interview_pages.interview_taker',compact('interview'));   
        }
        
    }
}
