<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    private function messages(): array
    {
        return [
            'phone_code.required'   => 'Network code is required.',
            'phone_code.regex'      => 'Enter a valid network code (e.g. 300, 321, 345).',
            'phone_number.required' => 'Phone number is required.',
            'phone_number.regex'    => 'Enter the 7-digit number.',
            'image.image'           => 'The photo must be an image file.',
            'image.mimes'           => 'The photo must be a JPG, PNG or WEBP file.',
            'image.max'             => 'The photo must be smaller than 2 MB.',
        ];
    }

    private function phoneRules(): array
    {
        return [
            'phone_code'   => ['required', 'regex:/^3[0-9]{2}$/'],
            'phone_number' => ['required', 'regex:/^[0-9]{7}$/'],
            'image'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function index()
    {
        $staff = Staff::withCount('services')->get();
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(array_merge([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:staff,email',
        ], $this->phoneRules()), $this->messages());

        $image = $request->hasFile('image')
            ? $request->file('image')->store('staff', 'public')
            : null;

        Staff::create([
            'name'  => $data['name'],
            'email' => $data['email'],
            'phone' => '+92' . $data['phone_code'] . $data['phone_number'],
            'image' => $image,
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member added successfully.');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate(array_merge([
            'name'  => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('staff', 'email')->ignore($staff->id)],
        ], $this->phoneRules()), $this->messages());

        $image = $staff->image;
        if ($request->hasFile('image')) {
            if ($staff->image) {
                Storage::disk('public')->delete($staff->image);
            }
            $image = $request->file('image')->store('staff', 'public');
        }

        $staff->update([
            'name'  => $data['name'],
            'email' => $data['email'],
            'phone' => '+92' . $data['phone_code'] . $data['phone_number'],
            'image' => $image,
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->appointments()->exists()) {
            return redirect()->route('admin.staff.index')
                ->with('error', 'Cannot delete: this staff member has appointments.');
        }

        if ($staff->image) {
            Storage::disk('public')->delete($staff->image);
        }

        $staff->services()->detach();
        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff member deleted.');
    }
}
