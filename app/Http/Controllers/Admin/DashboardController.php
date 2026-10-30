<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Staff;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services' => Service::count(),
            'staff' => Staff::count(),
            'pending' => Appointment::where('status', 'Pending')->count(),
            'today' => Appointment::whereDate('appointment_date', today())->count(),
        ];

        $recent = Appointment::with(['user', 'service', 'staff'])->latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }
}
