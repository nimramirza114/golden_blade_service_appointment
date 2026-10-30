<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $staff = Staff::with('services')->get();
        return view('admin.assignments.index', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        $services = Service::with('category')->get();
        $assigned = $staff->services()->pluck('services.id')->toArray();

        return view('admin.assignments.edit', compact('staff', 'services', 'assigned'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'services'   => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        $staff->services()->sync($request->input('services', []));

        return redirect()->route('admin.assignments.index')
    ->with('success', 'Services updated successfully for ' . $staff->name . '.');
    }
}
