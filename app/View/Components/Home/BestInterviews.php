<?php

namespace App\View\Components\Home;

use App\StarAnswer;
use Illuminate\View\Component;

class BestInterviews extends Component
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
        $interviews = StarAnswer::inRandomOrder()->select('*')->limit(3)->get();
        return view('components.home.best-interviews',compact('interviews'));
    }
}
