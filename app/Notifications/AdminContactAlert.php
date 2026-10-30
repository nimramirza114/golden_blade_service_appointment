<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminContactAlert extends Notification
{
    public function __construct(public ContactMessage $contact) {}

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title'      => 'New contact message',
            'message'    => $this->contact->name . ': ' . \Illuminate\Support\Str::limit($this->contact->message, 70),
            'url'        => route('admin.messages.show', $this->contact),
            'message_id' => $this->contact->id,
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New contact message from ' . $this->contact->name)
            ->replyTo($this->contact->email, $this->contact->name)   // hitting "Reply" answers the visitor
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Someone sent a message through the website contact form.')
            ->line('Name: ' . $this->contact->name)
            ->line('Email: ' . $this->contact->email)
            ->line('Message:')
            ->line($this->contact->message)
            ->action('Open in dashboard', route('admin.messages.show', $this->contact));
    }
}
