<?php

namespace App\View\Components\Interview;

use App\InterviewComment;
use App\Question;
use Illuminate\View\Component;

class InterviewComments extends Component
{
    public $slug;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $id = Question::select("id")->where(["slug" => $this->slug])->first()["id"];
        $comments = InterviewComment::where(["interview_id" => $id])->get();
        return view('components.interview.interview-comments', compact('id','comments'));
    }
}
