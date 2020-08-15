<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\QParty;
use App\User;

class QPartyInvitationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $qparty_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qparty_id)
    {
         $this->qparty_id = $qparty_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $qparty = QParty::find($this->qparty_id);
        $media_house_id = User::select('media_house')->where(["id" => $qparty->user_id])->first()['media_house'];
        $url = url('qparty')."/".$qparty->slug;
        return $this->markdown('emails.qpartyinvitation', compact('qparty','media_house_id','url'));
    }
}
