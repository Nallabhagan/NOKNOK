<?php

namespace App\View\Components\Home;

use Illuminate\View\Component;
use App\MediaHouse;

class MediaHouseComponent extends Component
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
        $media_houses = MediaHouse::inRandomOrder()->get();
        return view('components.home.media-house-component', compact('media_houses'));
    }
}
