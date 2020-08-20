<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use DB;

class PagesController extends Controller
{
	public function home_page() {
		return view('welcome');
	}

    public function give_your_interview() {
    	
    	return view('pages.give_your_interview');
    }

    public function user_profile($user) {
    	$user_id = Hashids::connection('user')->decode($user)[0];
    	return view('pages.user',compact('user_id'));
    }
}
