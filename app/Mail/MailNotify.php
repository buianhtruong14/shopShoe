<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $input;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from ItSolutionStuff.com')
        ->view('admin.send_mail');
        // return $this->markdown('admin.send_mail')
        //             ->with([
        //                 'message' => $this->input['message'],
        //             ])
        //             ->from('test@gmail.com', 'Vector Global')
        //             ->subject($this->input['subject']);
    }
}
