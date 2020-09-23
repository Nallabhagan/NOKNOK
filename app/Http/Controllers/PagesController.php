<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Interview;
use App\NokIt;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;


class PagesController extends Controller
{
	public function home_page() {
		return view('welcome');
	}
    public function paginate($items, $perPage = 5, $page = null, $options = [])

    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    }
    public function give_your_interview() {
    	
    	return view('pages.give_your_interview');
    }

    public function user_profile($user) {
        $user_id = Hashids::connection('user')->decode($user)[0];
        
        $feeds = NokIt::orderBy("id","DESC")->select('*')->where([["user_id", "=", $user_id],["status", "=", "POSTED"]])->get();
    	return view('pages.user',compact('user_id','feeds'));
    }

    public function shared_nokit($nokit_id)
    {
        $id = Hashids::connection('nokit')->decode($nokit_id)[0];
        $nokit = NokIt::find($id);
        $user_id = $nokit['user_id'];
        $content = $nokit['content'];
        return view('pages.shared_nokit',compact('user_id','id','content'));
    }

    public function answers_page($slug) {
        $interviews = Interview::where(["slug" => $slug])->get();
        $interview_title = Question::select("title")->where(["slug" => $slug])->first()["title"];
        return view('pages.interview_answers', compact('interviews','interview_title'));
    }
}
