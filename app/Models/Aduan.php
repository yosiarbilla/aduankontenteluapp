<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Aduan extends Model
{
    use HasFactory;

    protected $table = 'aduan';

    protected $fillable = [
        'ticket_id',
        'user_id',
        'kategori',
        'prioritas',
        'nomor_surat',
        'instansi',
        'surat_permintaan',
        'dokumen_pendukung',
        'catatan_tambahan',
        'status',
        'url_data'
    ];

    protected $casts = [
        'dokumen_pendukung' => 'array',
        'url_data' => 'array'
    ];

    // Accessor to get individual URL data fields when needed
    public function getPlatformAttribute()
    {
        if (!empty($this->url_data) && isset($this->url_data[0])) {
            return $this->url_data[0]['platform'] ?? null;
        }
        return null;
    }

    public function getUrlLinkAttribute()
    {
        if (!empty($this->url_data) && isset($this->url_data[0])) {
            return $this->url_data[0]['url_link'] ?? null;
        }
        return null;
    }

    public function getDeskripsiKontenAttribute()
    {
        if (!empty($this->url_data) && isset($this->url_data[0])) {
            return $this->url_data[0]['deskripsi_konten'] ?? null;
        }
        return null;
    }

    public function getScreenshotAttribute()
    {
        if (!empty($this->url_data) && isset($this->url_data[0])) {
            return $this->url_data[0]['screenshot'] ?? null;
        }
        return null;
    }

    public function getPasalAttribute()
    {
        if (!empty($this->url_data) && isset($this->url_data[0])) {
            return $this->url_data[0]['pasal'] ?? [];
        }
        return [];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($aduan) {
            // Generate unique ticket_id if not set
            if (empty($aduan->ticket_id)) {
                do {
                    $ticketId = strtoupper(Str::random(9));
                } while (static::where('ticket_id', $ticketId)->exists());
                
                $aduan->ticket_id = $ticketId;
            }
        });
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}