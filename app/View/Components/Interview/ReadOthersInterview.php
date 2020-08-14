<?php

namespace App\View\Components\Interview;

use Illuminate\View\Component;
use App\Interview;

class ReadOthersInterview extends Component
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
        $interviews = Interview::inRandomOrder()->select('*')->where(["question_id" => $this->id])->limit('5')->get();
        return view('components.interview.read-others-interview', compact('interviews'));
    }
}
