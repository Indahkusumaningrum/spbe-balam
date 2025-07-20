<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimKonfirmasiUser extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('Terima Kasih - Pesan Anda Telah Diterima | SPBE Bandar Lampung')
                    ->view('emails.user-confirmation') 
                    ->with([
                        'contact' => $this->contact
                    ]);
    }
}