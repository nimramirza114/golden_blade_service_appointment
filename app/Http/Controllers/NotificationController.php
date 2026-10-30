<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /** Click on a notification: mark it read, then go to its page. */
    public function open(Request $request, string $id)
    {
        $notification = $request->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect($notification->data['url'] ?? route('home'));
    }

    public function readAll(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return back();
    }

    /** Polled by the bell icon every few seconds so the badge updates without reloading. */
    public function count(Request $request)
    {
        $unread = $request->user()->unreadNotifications();

        return response()->json([
            'count'  => (clone $unread)->count(),
            'latest' => optional((clone $unread)->latest()->first())->data['title'] ?? null,
        ]);
    }
}
