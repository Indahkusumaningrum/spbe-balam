<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\VisitorLog;

class LogVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Catat hanya untuk request dengan metode GET, agar tidak mencatat setiap aksi POST atau AJAX
        if ($request->isMethod('get')) {
            VisitorLog::create([
                'ip'         => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }
        return $next($request);
    }
}
