<?php

namespace App\View\Components\NokIt;

use App\NokIt;
use Illuminate\View\Component;

class SingleFeed extends Component
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
        $feed = NokIt::orderBy("id","DESC")->select('*')->where(["id" => $this->id])->first();
        return view('components.nok-it.single-feed', compact('feed'));
    }
}
