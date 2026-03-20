<?php
use Illuminate\Mail\Mailable;

class MemberCardMail extends Mailable
{
    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function build()
    {
        return $this->subject('Your Membership Card')
            ->view('emails.member')
            ->attach($this->file);
    }
}