<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactNotification;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function store(Request $request)
    {
        // Log incoming request untuk debugging
        Log::info('Contact form submission attempt', [
            'name' => $request->name,
            'email' => $request->email,
            'message_length' => strlen($request->message ?? ''),
            'captcha' => $request->captcha
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10|max:1000',
            'captcha' => 'required|captcha'
        ], [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal 2 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'message.required' => 'Pesan harus diisi',
            'message.min' => 'Pesan minimal 10 karakter',
            'message.max' => 'Pesan maksimal 1000 karakter',
            'captcha.captcha' => 'Captcha tidak valid.'
        ]);

        if ($validator->fails()) {
            Log::warning('Contact form validation failed', [
                'errors' => $validator->errors()->toArray()
            ]);
            
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Test database connection dan save
            $contact = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);

            Log::info('Contact message saved to database', ['id' => $contact->id]);

            // Kirim notifikasi ke admin
            $adminResult = $this->sendAdminNotification($contact);
            
            // Kirim konfirmasi ke user
            $userResult = $this->sendUserConfirmation($contact);

            Log::info('Email sending completed', [
                'admin_success' => $adminResult,
                'user_success' => $userResult
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim! Terima kasih telah menghubungi kami.'
            ]);

        } catch (\Exception $e) {
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    private function sendAdminNotification($contact)
    {
        try {
            Mail::send('emails.notifikasi', compact('contact'), function ($message) {
                $message->to('erizatstva@gmail.com')
                        ->subject('Pesan Baru dari Website SPBE');
            });
            
            Log::info('Admin notification sent successfully');
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send admin notification: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    private function sendUserConfirmation($contact)
    {
        try {
            Mail::send('emails.notifikasi_user', compact('contact'), function ($message) use ($contact) {
                $message->to($contact->email)
                        ->subject('Terima kasih telah menghubungi SPBE BALAM');
            });
            
            Log::info('User confirmation sent successfully', ['email' => $contact->email]);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send user confirmation: ' . $e->getMessage(), [
                'email' => $contact->email,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}