<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; 

    
    public function __construct($user)
    {
        $this->user = $user;
    }

    
    public function build()
    {
        return $this->view('emails.user_passwordlost')
                    ->subject('Votre mot de passe a été réinitialisé')
                    ->with(['user' => $this->user]);
    }
}
