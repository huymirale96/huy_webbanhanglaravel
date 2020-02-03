<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer)
    {
        return $this->customer = $customer;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('website.mail.mail_forgot_password')
            ->subject('Yêu cầu lấy lại mật khẩu')
            ->with([
                'name' => $this->customer->name,
                'token' => $this->customer->token,
            ]);
    }
}
