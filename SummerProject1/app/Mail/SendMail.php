<?php

namespace App\Mail;

use App\bill;
use App\bill_detail;
use App\product;
use App\payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     protected $bill;
    //  protected $bill_detail;
    //  protected $product;
     protected $payment;

    public function __construct(Bill $bill, Payment $payment)
    {
        $this->bill = $bill;
        // $this->bill_detail = $bill_detail;
        // $this->product = $product;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('layout.orderMail')
                    ->with([
                        'orderBill' => $this->bill,
                        'orderPayment' => $this->payment->name,
                    ]);
    }
}
