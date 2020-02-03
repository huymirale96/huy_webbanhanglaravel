<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailAdminAutoReset extends Mailable
{
    use Queueable, SerializesModels;
    protected $name, $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $token)
    {
        $this->name = $name;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.auth.mail.mail_auto_reset')
            ->with('ĐẶT LẠI TÀI KHOẢN')
            ->with([
                'name' => $this->name,
                'token' => $this->token,
            ]);
    }
}
