<?php

namespace App\View\Components\Profile;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class TakenInterviews extends Component
{
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
       
        $interviews = DB::table('interviews')
                    ->select('interviews.*','questions.questions')
                    ->join('questions','interviews.question_id','=','questions.id')
                    ->where(['questions.user_id' => $this->id])
                    ->inRandomOrder()
                    ->paginate(8);
        return view('components.profile.taken-interviews',compact('interviews'));
    }
}
