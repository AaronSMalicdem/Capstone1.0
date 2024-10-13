<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
      /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }

        $userRole = Auth::user()->role->name;

        // Allow admins and finance to access both Kuwago and Uddesign views
        if (in_array($userRole, ['admin', 'finance_officer'])) {
            return $next($request); // Grant access to both views
        }

        // Deny access for Kuwago and Uddesign managers to Admin and Finance views
        if (in_array($userRole, ['kuwago_manager', 'uddesign_manager']) && in_array($request->route()->getName(), [
            'admin.dashboard',
            'finance.dashboard',
            'admin.users.index',
            'admin.users.create',
            'admin.users.edit',
            'admin.users.update',
            'admin.users.destroy',
            'admin.expenses-report',
        ])) {
            return response()->view('errors.access-denied', [], 403); // Show Access Denied page
        }

        // Otherwise, grant access if user role matches
        if (!in_array($userRole, $roles)) {
            return response()->view('errors.access-denied', [], 403); // Show Access Denied page
        }

        return $next($request); // Allow access
    }
}
