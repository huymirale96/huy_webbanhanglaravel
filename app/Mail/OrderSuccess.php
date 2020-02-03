<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccess extends Mailable
{
    use Queueable, SerializesModels;

//    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $customer, $order_detail, $total_money)
    {
        $this->order = $order;
        $this->customer = $customer;
        $this->order_detail = $order_detail;
        $this->total_money = $total_money;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('website.mail.mail_order_success')
            ->subject('Đặt hàng thành công')
            ->with([
                'order' => $this->order,
                'customer' => $this->customer,
                'detail' => $this->order_detail,
                'total_money' => $this->total_money,
            ]);
    }
}
