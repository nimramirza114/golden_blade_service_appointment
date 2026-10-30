<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
 public function index()
{
    $services = \App\Models\Service::with('category')->take(4)->get();
    $team = \App\Models\Staff::take(4)->get();

    return view('home', compact('services', 'team'));
}

public function contact()
{
    return view('contact');
}

public function sendContact(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:100',
        'email'   => 'required|email',
        'message' => 'required|string|min:10',
    ]);

    return redirect()->route('contact')->with('success', 'Thank you! Your message has been received.');
}



 public function about()
{
    $stats = [
        'barbers'  => \App\Models\Staff::count(),
        'services' => \App\Models\Service::count(),
    ];

    $team = \App\Models\Staff::orderBy('id')->get();

    return view('about', compact('stats', 'team'));
}

}
