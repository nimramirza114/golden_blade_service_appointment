<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Services\Notifier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    private array $statuses = ['Pending', 'Confirmed', 'Completed', 'Cancelled'];

    public function index(Request $request)
    {
        $appointments = Appointment::with(['user', 'service', 'staff'])
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->when($request->date, fn ($q, $date) => $q->whereDate('appointment_date', $date))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.appointments.index', [
            'appointments' => $appointments,
            'statuses' => $this->statuses,
        ]);
    }

    public function edit(Appointment $appointment)
    {
        return view('admin.appointments.edit', [
            'appointment' => $appointment->load(['user', 'service', 'staff']),
            'statuses' => $this->statuses,
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in($this->statuses)],
        ]);

        $appointment->status = $data['status'];
        $changed = $appointment->isDirty('status');
        $appointment->save();

        // tell the customer (email + bell) only when the status really changed
        if ($changed) {
            Notifier::statusChanged($appointment);
        }

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment status updated to ' . $data['status'] . '.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment #' . $appointment->id . ' deleted.');
    }

    /**
     * Opened from the link in the admin's email (signed URL, no login needed).
     * GET shows the appointment with Confirm / Cancel buttons, POST applies the choice.
     * A button + POST is used (not a plain link) so mail scanners that pre-open links can't change anything.
     */
    public function quick(Request $request, Appointment $appointment)
    {
        $appointment->load(['user', 'service', 'staff']);
        $result = null;

        if ($request->isMethod('post')) {
            $action = $request->validate(['action' => ['required', Rule::in(['Confirmed', 'Cancelled'])]])['action'];

            if ($appointment->status !== 'Pending') {
                $result = ['error', 'This appointment was already handled (status: ' . $appointment->status . ').'];
            } else {
                $appointment->status = $action;
                $appointment->save();
                Notifier::statusChanged($appointment);
                $result = ['success', 'Done! The appointment is now ' . $action . ' and the customer has been notified.'];
            }
        }

        return view('appointments.quick', compact('appointment', 'result'));
    }
}