<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
        'read_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'read_at'
    ];

    protected $attributes = [
        'status' => 'unread'
    ];

    /**
     * Scope untuk pesan yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    /**
     * Scope untuk pesan yang sudah dibaca
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Method untuk menandai pesan sebagai sudah dibaca
     */
    public function markAsRead()
    {
        $this->status = 'read';
        $this->read_at = now();
        $this->save();
        
        return $this;
    }

    /**
     * Method untuk menandai pesan sebagai belum dibaca
     */
    public function markAsUnread()
    {
        $this->status = 'unread';
        $this->read_at = null;
        $this->save();
        
        return $this;
    }

    /**
     * Accessor untuk format tanggal Indonesia
     */
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)
            ->setTimezone('Asia/Jakarta')
            ->format('l, d F Y');
    }

    /**
     * Accessor untuk format waktu
     */
    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->created_at)
            ->setTimezone('Asia/Jakarta')
            ->format('H:i');
    }

    /**
     * Accessor untuk cek apakah pesan sudah dibaca
     */
    public function getIsReadAttribute()
    {
        return $this->status === 'read';
    }

    /**
     * Accessor untuk mendapatkan class CSS berdasarkan status
     */
    public function getStatusClassAttribute()
    {
        return $this->status === 'read' ? 'success' : 'warning';
    }

    /**
     * Accessor untuk mendapatkan badge status
     */
    public function getStatusBadgeAttribute()
    {
        return $this->status === 'read' ? 'Sudah Dibaca' : 'Belum Dibaca';
    }
}