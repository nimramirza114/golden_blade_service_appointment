<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();
        $profile = $user->profile;

        return view('profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name'         => 'required|string|max:100',
            'email'        => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'phone_code'   => ['nullable', 'required_with:phone_number', 'regex:/^3[0-9]{2}$/'],
            'phone_number' => ['nullable', 'required_with:phone_code', 'regex:/^[0-9]{7}$/'],
            'address'      => 'nullable|string|max:255',
        ], [
            'phone_code.regex'           => 'Enter a valid network code (e.g. 300, 321, 345).',
            'phone_code.required_with'   => 'Network code is required.',
            'phone_number.regex'         => 'Enter the 7-digit number.',
            'phone_number.required_with' => 'Phone number is required.',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        $phone = (!empty($data['phone_code']) && !empty($data['phone_number']))
            ? '+92' . $data['phone_code'] . $data['phone_number']
            : null;

        // hasOne: create the profile if it does not exist yet
        $profile = $user->profile ?? $user->profile()->make();
        $profile->phone = $phone;
        $profile->address = $data['address'] ?? null;
        $user->profile()->save($profile);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate(['password' => ['required', 'current_password']]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
