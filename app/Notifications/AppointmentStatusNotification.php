<?php

namespace App\Notifications;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Sent to the customer: 'received' right after booking, then
 * 'Confirmed' / 'Cancelled' / 'Completed' when the admin changes the status.
 */
class AppointmentStatusNotification extends Notification
{
    public function __construct(public Appointment $appointment, public string $event = 'received')
    {
        $this->appointment->loadMissing(['service', 'staff']);
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    private function details(): string
    {
        $a = $this->appointment;
        return $a->service->name . ' with ' . $a->staff->name . ' on '
            . Carbon::parse($a->appointment_date)->format('D, d M Y') . ' at '
            . Carbon::parse($a->appointment_time)->format('h:i A');
    }

    private function copy(): array
    {
        return match ($this->event) {
            'received'  => ['Booking received', 'We received your booking and it is waiting for confirmation.'],
            'Confirmed' => ['Appointment confirmed', 'Good news! Your appointment has been confirmed. We look forward to seeing you.'],
            'Cancelled' => ['Appointment cancelled', 'Sorry, your appointment has been cancelled. Please book another time that suits you.'],
            'Completed' => ['Appointment completed', 'Thank you for visiting Golden Blade! We hope to see you again soon.'],
            default     => ['Appointment updated', 'Your appointment status is now ' . $this->event . '.'],
        };
    }

    public function toDatabase(object $notifiable): array
    {
        [$title, $text] = $this->copy();

        return [
            'title'          => $title,
            'message'        => $this->details(),
            'url'            => route('appointments.index'),
            'appointment_id' => $this->appointment->id,
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        [$title, $text] = $this->copy();

        $mail = (new MailMessage)
            ->subject($title . ' - Golden Blade')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line($text)
            ->line('Appointment: ' . $this->details())
            ->line('Status: ' . $this->appointment->status);

        return $this->event === 'Cancelled'
            ? $mail->action('Book a new appointment', route('appointments.create'))
            : $mail->action('View my appointments', route('appointments.index'));
    }
}
