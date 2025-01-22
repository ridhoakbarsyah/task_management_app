<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login
        if (Auth::check()) {
            $timeout = config('session.lifetime') * 60; // Waktu timeout dalam detik
            $lastActivity = session('last_activity', time());

            // Jika waktu terakhir aktivitas melebihi timeout, logout user
            if (time() - $lastActivity > $timeout) {
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();

                return redirect()->route('login')->with('message', 'Sesi Anda telah berakhir karena tidak ada aktivitas.');
            }

            // Perbarui waktu terakhir aktivitas
            session(['last_activity' => time()]);
        }

        return $next($request);
    }
}
