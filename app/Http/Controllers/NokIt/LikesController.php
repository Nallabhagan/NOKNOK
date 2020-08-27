<?php

namespace App\Http\Controllers\NokIt;

use App\Http\Controllers\Controller;
use App\NokIt;
use App\NokItLike;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class LikesController extends Controller
{
    public function like(Request $request)
    {
    	$nok_it_id = Hashids::connection('nokit')->decode($request->nokit_token)[0];
    	switch ($request->like_type) {
    		case 'Like':
    			$data = NokItLike::create([
    			    'user_id' => Auth::id(),
    			    'nok_it_id' => $nok_it_id,
    			]);

                if($data) {
                    $nokit_details = NokIt::find($nok_it_id);
                    $details = [
                        "notification_message" => "Liked your Nok It",
                        "user_id" => Auth::id(),
                        "nokit_url" => url('nokit').'/'.Hashids::connection('nokit')->encode($nok_it_id)
                    ];
                    $notify_user = User::find($nokit_details->user_id);
                    $notify_user->notify(new \App\Notifications\NokItLikeNotify($details));
                }
    			break;

    		case 'UnLike':
    			$data = NokItLike::where(['user_id' => Auth::id(),'nok_it_id' => $nok_it_id])->delete();
    			break;
    		
    		
    	}
    }
}
