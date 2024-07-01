<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if (!Auth::check()) {
        //     return redirect('/login');
        // }

        // $user = Auth::user();
        // // if ($user->role->name !== $role) {
        // //     return redirect('/'); // Or some other unauthorized page
        // // }
        // foreach ($roles as $role) {
        //     if ($user->role->name !== $role) {
        //         return redirect('/');
        //     }
        // }

        // return $next($request);

        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        foreach ($roles as $role) {
            if ($user->role->name === $role) {
                return $next($request);
            }
        }

        // return redirect('/unauthorized');
        // abort(403, 'Unauthorized action.');
        return response()->view('errors.403', [], 403);
    }
}