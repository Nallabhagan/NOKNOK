<?php

namespace App\Http\Controllers;

use App\Invite;
use App\QParty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\QPartyInvitationMail;
use Mail;

class QuestionPartyController extends Controller
{
    public function create_profile()
    {
    	return view('qparty.new_party.create_party');
    }

    public function store(Request $request)
    {

    	try
        {
            if($request->qparty_image != null)
            {
                $rules = array(
                    'qparty_title' => 'required',
                    'qparty_description' => 'required',
                    'qparty_image'  => 'required|image|max:2048'
                );

                $error = Validator::make($request->all(), $rules);

                if($error->fails())
                {
                    return redirect()->back()->withErrors(['errors' => $error->errors()->all()]);
                    // return response()->json(['errors' => $error->errors()->all()]);
                }

                $image = $request->file('qparty_image');

                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(('assets/qparty_thumbnails'), $new_name);
            }else{
                $new_name = "NULL";
            }

            $slug = Str::slug($request->qparty_title);
            $data = QParty::create([
                'user_id' => Auth::id(),
                'title' => $request->qparty_title,
                'description' => $request->qparty_description,
                'image' => $new_name,
                'slug' => $slug,
                'status' => "SAVED"
            ]);
            if($data)
            {
                do {
                    //generate a random string using Laravel's str_random helper
                    $token = Str::random();
                } //check if the token already exists and if it does, try again
                while (Invite::where('token', $token)->first());

                //create a new invite record
                $invite = Invite::create([
                    'email' => $request->invite_email,
                    'token' => $token,
                    'invite_id' => $data->id,
                    'type' => "qparty"
                ]);
                if($invite)
                {
                    $url = url('qparty')."/".$slug;
                    $qparty_id = $data->id;
                    $mail = Mail::to($request->invite_email)->send(new QPartyInvitationMail($qparty_id));
                    return redirect($url);
                }
            }
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                
                return redirect()->back()->withErrors(['errors' => "Q Party Title Already Taken"]);
               
            }
        }
    }
}
