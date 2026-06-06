<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Memastikan user yang mengakses route admin adalah
     * user yang sudah login DAN memiliki role admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 401);
            }
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah user adalah admin
        if (!auth()->user()->is_admin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden. Admin access only.'], 403);
            }

            // Log upaya akses ilegal (opsional tapi bagus untuk keamanan)
            \Log::warning('Non-admin user attempted to access admin area.', [
                'user_id' => auth()->id(),
                'username' => auth()->user()->username,
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
            ]);

            abort(403, 'Akses ditolak. Anda tidak memiliki izin admin.');
        }

        return $next($request);
    }
}
