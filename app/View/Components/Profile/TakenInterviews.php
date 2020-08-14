<?php

namespace App\View\Components\Profile;

use App\Question;
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
        $interviews = Question::inRandomOrder()->select('*')->where(["user_id" => $this->id])->get();
        return view('components.profile.taken-interviews',compact('interviews'));
    }
}
