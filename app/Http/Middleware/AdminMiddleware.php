<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

       /** @var User|null $user */
$user = Auth::user();

if (!$user || !$user->isAdmin()) {
    abort(403, 'Admins only.');
}

        return $next($request);
    }
}
