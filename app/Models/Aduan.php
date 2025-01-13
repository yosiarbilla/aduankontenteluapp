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
        'kategori',
        'prioritas',
        'nomor_surat',
        'instansi',
        'surat_permintaan',
        'dokumen_pendukung',
        'catatan_tambahan',
        'platform',
        'url_link',
        'screenshot',
        'deskripsi_konten',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($aduan) {
            do {
                $ticketId = strtoupper(Str::random(9));
            } while (static::where('ticket_id', $ticketId)->exists());

            $aduan->ticket_id = $ticketId;
        });
    }
}
