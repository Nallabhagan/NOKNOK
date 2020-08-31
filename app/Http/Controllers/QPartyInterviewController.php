<?php

namespace App\Http\Controllers;

use App\Invite;
use App\QParty;
use App\QPartyInterview;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class QPartyInterviewController extends Controller
{
    public function index(QParty $qparty)
    {
        
        if($qparty->status == "SAVED")
        {
        	if($qparty->member_id != NULL) //invite for noknok user
            {
                if($qparty->user_id != Auth::id()) 
                {
                    if($qparty->member_id == Auth::id()) // check valid guest
                    {
                        $invite_token = Invite::select('token')->where(["invite_id" => $qparty->id,"type" => "qparty"])->first()['token'];
                        $url = url('qparty/accept').'/'.Hashids::connection('qparty_slug')->encode($qparty->user_id).'/'.$invite_token;
                        return view('qparty.noknok_user.accept_invitation',compact('qparty','url'));
                    } else {
                        return redirect('/');
                    }
                } else {
                    // invite email id not a noknok user
                    $invite_token = Invite::select('token')->where(["invite_id" => $qparty->id,"type" => "qparty"])->first()['token'];
                    $url = url('qparty/accept').'/'.Hashids::connection('qparty_slug')->encode($qparty->user_id).'/'.$invite_token;
                    return redirect($url);
                }
            } 
        }
        else if($qparty->status == "ACCEPTED")
        {
        	$questions = QPartyInterview::orderBy('id','DESC')->select("*")->where(['qparty_id' => $qparty->id])->get();
        	return view('qparty.ask_question', compact('qparty','questions'));
        }
    }

    public function ask_question(Request $request) 
    {
    	
    	$qparty_id = Hashids::connection('qparty')->decode($request->qparty_token)[0];
    	
    	$validatedData = $request->validate([
    	    'question' => 'required',
    	]);
    	if($validatedData) 
    	{
    		$data = QPartyInterview::create([
	            'user_id' => Auth::id(),
	            'qparty_id' => $qparty_id,
	            'question' => $request->question,
	            'status' => "SAVED"
	        ]);
    	}
    	if($data) 
    	{
    		$qparty_details = QParty::find($qparty_id);

    		$details = [
    		    "notification_message" => "Asked a Question",
    		    "user_id" => Auth::id(),
    		    "interview_url" => url('qparty').'/'.Hashids::connection('qparty_slug')->encode(Auth::id()).'/'.$qparty_details->slug
    		];
    		$notify_user = User::find($qparty_details->member_id);
            $notify_user->notify(new \App\Notifications\QParty($details));
            return redirect()->back();
    	}
    }

    public function answer(Request $request)
    {
    	
    	$question_id = Hashids::connection('qparty')->decode($request->question_token)[0];
        $validatedData = $request->validate([
            'answer' => 'required',
        ]);
        if($validatedData) 
        {
            $data = QPartyInterview::where(["id" => $question_id])->update(["answer" => $request->answer]);
        }
        if($data) 
        {
            $qparty_question_info = QPartyInterview::select("qparty_id","user_id")->where(["id" => $question_id])->first();

            $qparty_details = QParty::find($qparty_question_info['qparty_id']);
            
            $details = [
                "notification_message" => "Answered your Question",
                "user_id" => $qparty_details['member_id'],
                "interview_url" => url('qparty').'/'.Hashids::connection('qparty_slug')->encode($qparty_question_info['user_id']).'/'.$qparty_details->slug
            ];
            $notify_user = User::find($qparty_question_info['user_id']);
            $notify_user->notify(new \App\Notifications\QParty($details));
            return redirect()->back();
        }
        

    }

    public function single_user_question($user, $slug)
    {
    	
        $qparty = QParty::select('*')->where(["slug" => $slug])->first();
        $qparty_id = $qparty['id'];
        $user_id = Hashids::connection('qparty_slug')->decode($user)[0];
       	$questions = QPartyInterview::orderBy("id","DESC")->select("*")->where(["qparty_id" => $qparty_id, "user_id" => $user_id])->get();
        return view('qparty.ask_question', compact('qparty','questions'));
    }
}
