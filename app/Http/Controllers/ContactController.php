<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Services\Notifier;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $v = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'nullable|string|max:50',
            'email'      => 'required|email|max:150',
            'phone'      => 'nullable|string|max:30',
            'message'    => 'required|string|min:10|max:2000',
        ], [
            'message.min' => 'Please write at least 10 characters.',
        ]);

        // table has name/email/message only: join the names, put the phone (if any) on top of the message
        $data = [
            'name'    => trim($v['first_name'] . ' ' . ($v['last_name'] ?? '')),
            'email'   => $v['email'],
            'message' => (filled($v['phone'] ?? null) ? 'Phone: ' . $v['phone'] . "\n\n" : '') . $v['message'],
        ];

        // 1) save first: if this fails an exception is thrown and NO success message is shown
        $contact = ContactMessage::create($data);

        // 2) tell the admin(s) - on-site notification + email
        Notifier::contact($contact);

        return redirect()->route('contact')
            ->with('success', 'Thank you, ' . $contact->name . '! Your message has been received. We will reply to your email soon.');
    }
}