<?php

namespace App\Notifications;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

/**
 * Sent to every admin when a customer books ('new') or cancels ('cancelled').
 * Not queued on purpose: QUEUE_CONNECTION=database would need a queue worker running.
 */
class AdminAppointmentAlert extends Notification
{
    public function __construct(public Appointment $appointment, public string $event = 'new')
    {
        $this->appointment->loadMissing(['user', 'service', 'staff']);
    }

    // database first, so the on-site notification is saved even if the email fails
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    private function when(): string
    {
        $a = $this->appointment;
        return Carbon::parse($a->appointment_date)->format('D, d M Y') . ' at '
            . Carbon::parse($a->appointment_time)->format('h:i A');
    }

    private function title(): string
    {
        return $this->event === 'new' ? 'New appointment booked' : 'Appointment cancelled by customer';
    }

    private function summary(): string
    {
        $a = $this->appointment;
        return "{$a->user->name} - {$a->service->name} with {$a->staff->name}, {$this->when()}";
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title'          => $this->title(),
            'message'        => $this->summary(),
            'url'            => route('admin.appointments.edit', $this->appointment),
            'appointment_id' => $this->appointment->id,
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $a = $this->appointment;

        $mail = (new MailMessage)
            ->subject($this->title() . ' - #' . $a->id)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line($this->event === 'new'
                ? 'A customer has just booked an appointment.'
                : 'A customer has cancelled their appointment.')
            ->line('Customer: ' . $a->user->name . ' (' . $a->user->email . ')')
            ->line('Service: ' . $a->service->name)
            ->line('Barber: ' . $a->staff->name)
            ->line('When: ' . $this->when())
            ->line('Status: ' . $a->status);

        if ($a->notes) {
            $mail->line('Notes: ' . $a->notes);
        }

        if ($this->event === 'new') {
            // signed link, valid 7 days - admin can confirm/cancel without logging in
            $quick = URL::temporarySignedRoute('appointments.quick', now()->addDays(7), ['appointment' => $a->id]);
            $mail->action('Confirm or Cancel this appointment', $quick)
                 ->line('Or manage it from the admin dashboard: ' . route('admin.appointments.edit', $a));
        } else {
            $mail->action('Open in dashboard', route('admin.appointments.edit', $a));
        }

        return $mail;
    }
}
