<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->has('member')) {
            //set session for noknok member if current user ask an interview to the noknok user
            Session::put('member_id', $request->query('member'));
            $member_id = Hashids::connection('user')->decode(Session::get('member_id'))[0];
            if($member_id == Auth::id()) {
                return redirect('create-interview');
            } else {
                return view('interviews.new_interview.create');
            }
        }

        if($request->has('preview')) {
            $id = $request->query('preview');
        	$questions = self::get_interview_info($id);
        	if(Auth::id() == $questions[0]->user_id && $questions[0]->status == "SAVED")
            {
                $id = Hashids::connection('create_question')->encode($questions[0]->id);
                $title = $questions[0]->title;
                $description = $questions[0]->description;
        		return view('interviews.new_interview.preview',compact('id','title','description'));	
        	} else if ($questions[0]->status == "PUBLISHED") {
                return "Your are Published";
            }
        } else if($request->has('published')){
            $id = $request->query('published');
            $questions = self::get_interview_info($id);
            if(Auth::id() == $questions[0]->user_id && $questions[0]->status == "PUBLISHED") 
            {
                return view('interviews.new_interview.published_interview',compact('questions'));
            } else if ($questions[0]->status == "SAVED") {
                return view('interviews.new_interview.preview',compact('id'));  
            }        	
        } else {
            return view('interviews.new_interview.create'); 
        }
    }

    //Store function
    public function store(Request $request) 
    {
    	try {
            $privacy_status = "";
            if(Auth::id() == 1) {
                $privacy_status = "PUBLIC";
            } else {
                $privacy_status = "PRIVATE";
            }
            $validatedData = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'question' => 'required|array|min:3'
            ]);
            if($validatedData) {
                $slug = Str::slug($request->title);
                $data = Question::create([
                    'user_id' => Auth::id(),
                    'title' => $request->title,
                    'description' => $request->description,
                    'questions' => $request->question,
                    'slug' => $slug,
                    'status' => 'SAVED',
                    'privacy_status' => $privacy_status
                ]); 
                if($data) {
                    return response()->json(array('success' => true, 'interview_token' => Hashids::connection('create_question')->encode($data->id)), 200);
                }
            }
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return response()->json([
                        'errors' => [
                            'title' => ['Interview Title Already Taken']
                        ]
                ], 422);
            }
        }
        
    }

    public function publish_interview(Request $request) {
        $interview_id =  Hashids::connection('create_question')->decode($request->interview_id)[0];

        // notify if current user ask for an interview to the noknok user
        if(Session::has('member_id')) { 
            $member_id = Hashids::connection('user')->decode(Session::get('member_id'))[0];
            $interview_slug = Question::select('slug')->where(['id' => $interview_id])->first()['slug'];

            $url = url('/').'/'.$interview_slug;
            $details = [
                "notification_message" => "Invited you for an Interview",
                "user_id" => Auth::id(),
                "interview_url" => $url
            ];
            $notify_user = User::find($member_id);
            $notify_user->notify(new \App\Notifications\InviteInterview($details));
            Session::forget('member_id');//remove session
            
        } 
        if($request->interview_thumbnail != null)
        {
            $rules = array(
              'interview_thumbnail'  => 'required|image|max:2048'
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return redirect()->back()->withErrors(['errors' => $error->errors()->all()]);
                // return response()->json(['errors' => $error->errors()->all()]);
            }

            $image = $request->file('interview_thumbnail');

            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(('assets/interview_thumbnails'), $new_name);
        }else{
            $new_name = "NULL";
        }
        
        $publish_interview = Question::where(['id' => $interview_id])->update(['status' => 'PUBLISHED','thumbnail_image' => $new_name]);

        if($publish_interview) {
            $url = url('create-interview')."?published=".$request->interview_id;
            return redirect($url);
        }
    }

    
    //get questions from API Call
    public function get_questions($id) {
        $question_id = Hashids::connection('create_question')->decode($id);
        return $question = Question::select('title','description','questions')->where(["id" =>$question_id])->get();
        
    }

    //self calling function within this controller
    public function get_interview_info($id) {
        $question_id = Hashids::connection('create_question')->decode($id);
        return $questions = Question::find($question_id);
    }
}
