<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Services\Notifier;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $services = Service::with('staff')->get();
        $selected = $request->query('service');

        return view('appointments.create', compact('services', 'selected'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id'       => 'required|exists:services,id',
            'staff_id'         => 'required|exists:staff,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'notes'            => 'nullable|string|max:500',
        ], [
            'service_id.required'             => 'Please select a service.',
            'staff_id.required'               => 'Please select a barber.',
            'appointment_date.required'       => 'Please choose a date.',
            'appointment_date.after_or_equal' => 'The appointment date cannot be in the past.',
            'appointment_time.required'       => 'Please choose a time.',
        ]);

        $service = Service::findOrFail($data['service_id']);

        // Server-side: staff must be assigned to this service
        if (!$service->staff()->where('staff.id', $data['staff_id'])->exists()) {
            return back()->withInput()
                ->withErrors(['staff_id' => 'The selected barber does not offer this service.']);
        }

        // No booking in the past (today + earlier time)
        $when = \Carbon\Carbon::parse($data['appointment_date'] . ' ' . $data['appointment_time']);
        if ($when->isPast()) {
            return back()->withInput()
                ->withErrors(['appointment_time' => 'The appointment time cannot be in the past.']);
        }

        $appointment = new Appointment($data);
        $appointment->user_id = auth()->id();   // never from the form
        $appointment->status  = 'Pending';      // always starts as Pending
        $appointment->save();

        // admin gets alert + email (with Confirm/Cancel link), customer gets "booking received"
        Notifier::newBooking($appointment);

        return redirect()->route('appointments.index')
            ->with('success', 'Your appointment has been booked and is pending confirmation. We have also sent you an email.');
    }

    public function index()
    {
        $appointments = auth()->user()->appointments()->with(['service', 'staff'])->latest()->get();
        return view('appointments.index', compact('appointments'));
    }

    public function cancel(Appointment $appointment)
    {
        // Only the owner can cancel
        abort_unless($appointment->user_id === auth()->id(), 403);

        if ($appointment->status !== 'Pending') {
            return back()->with('error', 'Only pending appointments can be cancelled.');
        }

        $appointment->status = 'Cancelled';
        $appointment->save();

        Notifier::cancelledByCustomer($appointment);

        return back()->with('success', 'Your appointment has been cancelled.');
    }
}
