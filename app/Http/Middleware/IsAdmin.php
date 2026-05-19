<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin // atau nama middleware role Anda
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user belum login sama sekali
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Jika SUDAH login, tapi rolenya BUKAN admin
        if (auth()->user()->role !== 'admin') {
            // Langsung kunci dengan 403 Forbidden (Akses Ditolak)
            abort(403, 'Unauthorized. Admin access required.');
            
            // ATAU jika ingin lebih aman (pura-pura rute tidak ada), gunakan:
            // abort(404);
        }

        return $next($request);
    }
}