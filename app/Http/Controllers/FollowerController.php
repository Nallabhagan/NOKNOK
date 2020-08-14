<?php

namespace App\Http\Controllers;

use App\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class FollowerController extends Controller
{
    public function follow(Request $request)
    {
    	$following_id = Hashids::connection('user')->decode($request->following_id)[0];
    	$data = Follower::create([
    	        'user_id' => Auth::id(),
    	        'following_id' => $following_id
    	    ]);
    }

    public function unfollow(Request $request)
    {
        
        $following_id = Hashids::connection('user')->decode($request->following_id)[0];
        $follow = Follower::where(['user_id'=>Auth::id(),'following_id'=>$following_id])->delete();
    }
}
