<?php

namespace App\View\Components\Interview;

use App\StarAnswer;
use Illuminate\View\Component;

class RelatedInterviews extends Component
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
        $interviews = StarAnswer::inRandomOrder()->select('*')->limit(6)->get();
        return view('components.interview.related-interviews', compact('interviews'));
    }
}
