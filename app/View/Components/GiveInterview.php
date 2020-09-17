<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Question;

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
        $interviews = Question::select('title', 'description', 'slug', 'thumbnail_image')->where(['privacy_status' => 'PUBLIC'])->orderBy("id", "DESC")->paginate(8);
        
        return view('components.give-interview', compact('interviews'));
    }
}
