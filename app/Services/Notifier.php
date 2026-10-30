<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\ContactMessage;
use App\Models\User;
use App\Notifications\AdminAppointmentAlert;
use App\Notifications\AdminContactAlert;
use App\Notifications\AppointmentStatusNotification;

/**
 * One place that sends notifications. A mail problem (wrong SMTP password, no internet...)
 * is logged and never breaks booking / contact form for the visitor.
 */
class Notifier
{
    public static function newBooking(Appointment $a): void
    {
        self::toAdmins(fn () => new AdminAppointmentAlert($a, 'new'));
        self::toCustomer($a, 'received');
    }

    public static function cancelledByCustomer(Appointment $a): void
    {
        self::toAdmins(fn () => new AdminAppointmentAlert($a, 'cancelled'));
    }

    public static function statusChanged(Appointment $a): void
    {
        if (in_array($a->status, ['Confirmed', 'Cancelled', 'Completed'], true)) {
            self::toCustomer($a, $a->status);
        }
    }

    public static function contact(ContactMessage $m): void
    {
        self::toAdmins(fn () => new AdminContactAlert($m));
    }

    private static function toCustomer(Appointment $a, string $event): void
    {
        $user = $a->user ?? User::find($a->user_id);
        if (!$user) {
            return;
        }
        try {
            $user->notify(new AppointmentStatusNotification($a, $event));
        } catch (\Throwable $e) {
            report($e);
        }
    }

    private static function toAdmins(callable $make): void
    {
        foreach (User::admins()->get() as $admin) {
            try {
                $admin->notify($make());
            } catch (\Throwable $e) {
                report($e);   // keep going so the other admins still get theirs
            }
        }
    }
}
