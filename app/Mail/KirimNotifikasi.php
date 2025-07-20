<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KirimNotifikasi extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $url;

    public function __construct($nama, $url)
    {
        $this->nama = $nama;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Notifikasi dari SPBE BALAM')
                    ->view('emails.notifikasi') 
                    ->with([
                        'nama' => $this->nama,
                        'url' => $this->url
                    ]);
    }
}
