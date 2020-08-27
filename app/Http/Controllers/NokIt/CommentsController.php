<?php

namespace App\Http\Controllers\NokIt;

use App\Http\Controllers\Controller;
use App\NokIt;
use App\NokItComment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class CommentsController extends Controller
{
    public function save_comment(Request $request)
    {
    	$nok_it_id = Hashids::connection('nokit')->decode($request->nok_it_token)[0];
    	$data = NokItComment::create([
            'user_id' => Auth::id(),
            'nok_it_id' => $nok_it_id,
            'comment' => $request->comment
        ]);

        if($data) {
            $nokit_details = NokIt::find($nok_it_id);
            $details = [
                "notification_message" => "Commented on your Nok It",
                "user_id" => Auth::id(),
                "nokit_url" => url('nokit').'/'.Hashids::connection('nokit')->encode($nok_it_id)
            ];
            $notify_user = User::find($nokit_details->user_id);
            $notify_user->notify(new \App\Notifications\NokItCommentNotify($details));
        }
    	
    }
}
