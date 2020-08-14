<?php

namespace App\View\Components\Home;

use Illuminate\View\Component;
use App\Brand;

class AskQuestion extends Component
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
        $brands = Brand::select('*')->get();
        return view('components.home.ask-question',compact('brands'));
    }
}
