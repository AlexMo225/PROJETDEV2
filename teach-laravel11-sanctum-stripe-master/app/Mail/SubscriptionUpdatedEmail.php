<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionUpdatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subscription;

    public function __construct($user, $subscription)
    {
        $this->user = $user;
        $this->subscription = $subscription;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Abonnement mis à jour avec succès',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription_updated',
            with: ['user' => $this->user, 'subscription' => $this->subscription],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
