<?php

namespace App\View\Components\Profile;


use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class QParty extends Component
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
        //the model and component name are same thats y i fetch data using DB class
        $qparties = DB::table('q_parties')->select("*")->where(["user_id" => $this->id, "status" => "ACCEPTED"])->get();
       
        return view('components.profile.q-party',compact('qparties'));
    }
}
