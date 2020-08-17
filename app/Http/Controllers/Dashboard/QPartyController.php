<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\QParty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QPartyController extends Controller
{
    public function index()
    {
    	
    	$qparties = QParty::orderBy("id","DESC")->select('*')->where(["user_id" => Auth::id()])->get();
    	return view('dashboard.qparty.list', compact('qparties'));
    }
}
