<?php

namespace App\Http\Controllers;

use App\Invite;
use App\QParty;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class InviteController extends Controller
{
    public function qparty_process($user, $token)
    {
    	$user_id = Hashids::connection('qparty_slug')->decode($user)[0];
    	$invite  = Invite::select('email','invite_id')->where(["token" => $token])->first();
        $qparty = QParty::find($invite['invite_id']);

    	//check  valid guest email id
    	if($invite['email'] == Auth::user()->email)
    	{
    		
    		$data = QParty::where(["id" => $invite['invite_id']])->update(["member_id" => Auth::id(),"status" => "ACCEPTED"]);
    		if($data)
    		{
    			$delete_invitation = Invite::where(["token" => $token])->delete();
    			if($delete_invitation)
    			{
                    $url = url('qparty')."/".$qparty->slug;
                    $details = [
                        "notification_message" => "Accepted your QParty Invitation",
                        "user_id" => Auth::id(),
                        "qparty_url" => $url
                    ];
                    $notify_user = User::find($user_id);
                    $notify_user->notify(new \App\Notifications\InviteQparty($details));
    				
    				return redirect($url);
    			}
    		}
    	}
    	else
    	{
            //check valid host
            if(Auth::id() == $qparty->user_id)
            {
                if($qparty->status == "ACCEPTED")
                {
                    $url = url('qparty')."/".$qparty->slug;
                    return redirect($url); 
                }
                else
                {
                    return view('qparty.new_party.creater', compact('qparty'));
                }
                
            }
            else
            {
                return redirect('/');
            }
    	}
    }

    public function qparty_invite($token)
    {
        return $token;
    }
}
