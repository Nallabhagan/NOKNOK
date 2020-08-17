<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    public function index()
    {
    	
    	$interviews = Question::orderBy("id","DESC")->select('*')->where(["user_id" => Auth::id(), "status" => "PUBLISHED"])->get();
    	return view('dashboard.interviews.list', compact('interviews'));
    }
}
