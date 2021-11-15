<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $editableOrder;
    public $nome;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($editableOrder, $nome)
    {
        $this -> editableOrder = $editableOrder;
        $this -> nome = $nome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.new-order');
    }
}
