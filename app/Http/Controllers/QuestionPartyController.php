<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Mail\QPartyInvitationMail;
use App\QParty;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use Vinkla\Hashids\Facades\Hashids;

class QuestionPartyController extends Controller
{
    public function create_profile(Request $request)
    {

        if($request->has('member')) {
            $member_id = Hashids::connection('user')->decode($request->query('member'))[0];

            if(Auth::id() != $member_id) // avoid invite for same login user
            {
                return view('qparty.new_party.create_party',compact('member_id'));
            } else {
                return redirect('qparty/create_profile');
            }
            
        } else {
            return view('qparty.new_party.create_party');
        }
    }

    public function store(Request $request)
    {
        $member_id = NULL;
        $invite_email = "";
        if(isset($request->member_token))
        {
            $member_id = Hashids::connection('user')->decode($request->member_token)[0];
            $invite_email = User::select('email')->where(['id' => $member_id])->first()['email'];
        } else {
             $invite_email = $request->invite_email;
        }

        
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
                'member_id' => $member_id,
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
                    'email' => $invite_email,
                    'token' => $token,
                    'invite_id' => $data->id,
                    'type' => "qparty"
                ]);
                if($invite)
                {
                    $url = url('qparty')."/".$slug;
                    $qparty_id = $data->id;
                    if(isset($request->member_token)) 
                    {
                        // for noknok member to send noknok notification
                        $details = [
                            "notification_message" => "Invited you for a QParty",
                            "user_id" => Auth::id(),
                            "qparty_url" => $url
                        ];
                        $notify_user = User::find($member_id);
                        $notify_user->notify(new \App\Notifications\InviteQparty($details));
                    } else {
                        // for new member to send email
                        $mail = Mail::to($invite_email)->send(new QPartyInvitationMail($qparty_id));
                    }
                    
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
