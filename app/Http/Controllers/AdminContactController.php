<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminContactController extends Controller

{

    public function index()
    {
        return view('admin.dashboard_admin');
    }

    public function tahapan(){
        return view ('admin.tahapan_spbe_admin');
    }

    public function indexContact(Request $request)
    {
        $query = ContactMessage::orderBy('created_at', 'desc');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->get();
        
        $stats = [
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::unread()->count(),
            'read' => ContactMessage::read()->count()
        ];

        return view('admin.kontak_show_admin', compact('messages', 'stats'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read if not already
        if ($message->status === 'unread') {
            $message->markAsRead();
        }

        return view('admin.contact.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }

    public function count()
    {
        return response()->json([
            'total' => ContactMessage::count(),
            'unread' => ContactMessage::unread()->count(),
            'read' => ContactMessage::read()->count()
        ]);
    }

    /**
     * Method untuk menandai pesan sebagai sudah dibaca
     * Diakses dari link di email admin
     */
    public function markAsReadFromEmail($id)
    {
        try {
            $message = ContactMessage::findOrFail($id);

            // Update status jika belum dibaca
            if ($message->status !== 'read') {
                $message->status = 'read';
                $message->read_at = now();
                $message->save();
            }

            // Redirect ke dashboard admin dengan pesan sukses
            return redirect()->route('admin.contact.index')
                ->with('success', 'Pesan telah ditandai sebagai sudah dibaca.');

        } catch (\Exception $e) {
            return redirect()->route('admin.contact.index')
                ->with('error', 'Gagal menandai pesan sebagai sudah dibaca.');
        }
    }

    /**
     * Method untuk menandai pesan sebagai sudah dibaca dari dashboard
     */
    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);

        // Update status jika belum dibaca
        if ($message->status !== 'read') {
            $message->status = 'read';
            $message->read_at = now();
            $message->save();
        }

        return redirect()->route('admin.contact.show', $id)
            ->with('success', 'Pesan telah ditandai sebagai sudah dibaca.');
    }

    /**
     * Ajax method untuk update status tanpa reload halaman
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $message = ContactMessage::findOrFail($id);
            
            $message->status = $request->status;
            if ($request->status === 'read') {
                $message->read_at = now();
            }
            $message->save();

            return response()->json([
                'success' => true,
                'message' => 'Status pesan berhasil diupdate',
                'data' => [
                    'id' => $message->id,
                    'status' => $message->status,
                    'read_at' => $message->read_at
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status pesan'
            ], 500);
        }
    }
}