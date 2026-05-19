<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Jika belum login, barulah dilempar ke form login utama
        if (!Auth::check()) {
            return redirect()->route('landing');
        }

        // 2. Jika role user tidak sesuai dengan parameter rute (misal: user biasa akses admin)
        if (Auth::user()->role !== $role) {
            
            // Jika dia admin tersesat ke rute user, arahkan ke dashboard admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            // JIKA USER BIASA AKSES ADMIN: Langsung kunci ke /home (Jangan ke form login!)
            return redirect()->route('user.homepage')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}