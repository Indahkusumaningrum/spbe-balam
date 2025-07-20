<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactNotification;

class EmailController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10|max:1000'
        ], [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal 2 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'message.required' => 'Pesan harus diisi',
            'message.min' => 'Pesan minimal 10 karakter',
            'message.max' => 'Pesan maksimal 1000 karakter'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $contact = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);

            // Kirim notifikasi ke admin
            $this->sendAdminNotification($contact);
            
            // Kirim konfirmasi ke user
            $this->sendUserConfirmation($contact);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim! Terima kasih telah menghubungi kami.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.'
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
        } catch (\Exception $e) {
            \Log::error('Failed to send admin notification: ' . $e->getMessage());
        }
    }

    private function sendUserConfirmation($contact)
    {
        try {
            Mail::send('emails.notifikasi_user', compact('contact'), function ($message) use ($contact) {
                $message->to($contact->email)
                        ->subject('Terima kasih telah menghubungi SPBE BALAM');
            });
        } catch (\Exception $e) {
            \Log::error('Failed to send user confirmation: ' . $e->getMessage());
        }
    }

    // Method ini dihapus karena sudah ada di AdminContactController
    // untuk menghindari duplikasi dan konflik routing
}