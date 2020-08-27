<?php

namespace App\View\Components\NokIt;

use App\NokItComment;
use Illuminate\View\Component;

class FeedComments extends Component
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
        $comments = NokItComment::select("*")->where(["nok_it_id" => $this->id])->get();
        return view('components.nok-it.feed-comments', compact('comments'));
    }
}
