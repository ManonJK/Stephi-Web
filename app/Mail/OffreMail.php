<?php

namespace App\Mail;

use App\User;
use App\Bien;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OffreMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The price of the offer
     * @var $prix
    */
    public $prix;

    /**
     * The customer
     * @var $customer
     */
    public $customer;

    /**
     * The real estate
     * @var $estate
     */
    public $estate;

    /**
     * Create a new message instance.
     *
     * @param User $customer
     * @param $prix
     * @param Bien $estate
     * @return void
     */
    public function __construct(User $customer, $prix, $estate)
    {
        $this->customer = $customer;
        $this->prix = $prix;
        $this->estate = $estate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.offre');
    }
}
