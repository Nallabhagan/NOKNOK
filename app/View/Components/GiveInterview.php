<?php

namespace App\View\Components;

use App\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class GiveInterview extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $interviews = DB::table('interviews')
                 ->join('questions','questions.id','=','interviews.question_id')
                 ->select('question_id', DB::raw('count(*) as answer_count'))
                 ->groupBy('question_id')
                 ->where(['questions.privacy_status' => 'PUBLIC'])
                 ->orderBy('answer_count','DESC')
                 ->paginate(6);
        // $interviews = Question::select("*")->where(['privacy_status' => 'PUBLIC'])->orderBy("id", "DESC")->paginate(6);
        
        return view('components.give-interview', compact('interviews'));
    }
}
