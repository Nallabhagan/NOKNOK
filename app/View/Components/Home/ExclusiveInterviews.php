<?php

namespace App\View\Components\Home;

use App\Interview;
use DB;
use Illuminate\View\Component;

class ExclusiveInterviews extends Component
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
        $interviews = DB::select("SELECT * FROM interviews WHERE question_id IN ( SELECT question_id FROM interviews GROUP BY question_id HAVING count(*) = 1 )");
        return view('components.home.exclusive-interviews',compact('interviews'));
    }
}
