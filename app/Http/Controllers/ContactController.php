<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Services\Notifier;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'message.min' => 'Please write at least 10 characters.',
        ]);

        // 1) save first: if this fails an exception is thrown and NO success message is shown
        $contact = ContactMessage::create($data);

        // 2) tell the admin(s) - on-site notification + email
        Notifier::contact($contact);

        return redirect()->route('contact')
            ->with('success', 'Thank you, ' . $contact->name . '! Your message has been received. We will reply to your email soon.');
    }
}
