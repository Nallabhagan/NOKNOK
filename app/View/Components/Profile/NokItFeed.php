<?php

namespace App\View\Components\profile;

use App\NokIt;
use Illuminate\View\Component;

class NokItFeed extends Component
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
        $feeds = NokIt::orderBy("id","DESC")->select('*')->where(["user_id" => $this->id])->get();
        return view('components.profile.nok-it-feed', compact('feeds'));
    }
}
