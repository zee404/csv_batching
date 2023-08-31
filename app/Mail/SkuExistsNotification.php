<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SkuExistsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sku;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sku)
    {
        $this->sku =$sku;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('SKU Already Exists')->markdown('emails.sku_exists')->with('sku',$this->sku);
    }
}
