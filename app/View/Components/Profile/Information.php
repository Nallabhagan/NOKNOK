<?php

namespace App\View\Components\Profile;

use App\Interview;
use App\User;
use Illuminate\View\Component;

class Information extends Component
{
    public $id;
    public $media_id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->media_id = User::select("media_house")->where(["id" => $id])->first()['media_house'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $interviews = Interview::inRandomOrder()->select('*')->limit(8)->get();
        return view('components.profile.information',compact('interviews'));
    }
}
