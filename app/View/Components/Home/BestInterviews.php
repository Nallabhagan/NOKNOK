<?php

namespace App\View\Components\Home;

use App\Interview;
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
        $interviews = Interview::inRandomOrder()->select('*')->limit(6)->get();
        return view('components.home.best-interviews',compact('interviews'));
    }
}
