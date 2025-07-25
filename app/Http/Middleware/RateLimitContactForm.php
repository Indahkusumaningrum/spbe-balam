<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // TAMBAHKAN INI - INI YANG HILANG!
use Symfony\Component\HttpFoundation\Response;

class RateLimitContactForm
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $key = 'contact-form:' . $ip;

        if (Cache::has($key)) {
            return response()->json([
                'success' => false,
                'message' => 'Tunggu sebentar sebelum mengirim pesan lagi.'
            ], 429);
        }

        $response = $next($request);

        // Hanya set rate limit jika request berhasil
        if ($response->getStatusCode() === 200) {
            $responseData = json_decode($response->getContent(), true);
            
            // Hanya set rate limit jika contact form benar-benar berhasil dikirim
            if (isset($responseData['success']) && $responseData['success'] === true) {
                // Set rate limit: 1 pesan per 5 menit (300 detik)
                Cache::put($key, true, now()->addSeconds(300));
            }
        }

        return $response;
    }
}