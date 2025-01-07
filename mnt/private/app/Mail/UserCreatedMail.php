<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // Passer des données à la vue

    
    public function __construct($user)
    {
        $this->user = $user;
    }

    
    public function build()
    {
        return $this->view('emails.user_created')
                    ->subject('Votre compte a été créé')
                    ->with(['user' => $this->user]);
    }
}