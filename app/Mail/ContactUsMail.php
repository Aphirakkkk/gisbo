<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $topic = $this->contactData['topic'] ?? 'ข้อความติดต่อใหม่';
        return $this->subject('[GIS GROUP] มีข้อความติดต่อใหม่: ' . $topic)
                    ->view('emails.contact_us');
    }
}
