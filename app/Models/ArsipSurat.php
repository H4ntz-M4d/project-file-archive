<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    protected $table = 'arsip_surats';
    protected $primaryKey = 'id_arsip_surat';

    protected $fillable = [
        'nomor_surat',
        'id_kategori',
        'judul',
        'waktu_pengarsipan',
        'berkas',
        'slug'
    ];

    public $timestamps = true;

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($arsip) {
            $arsip->slug = md5(now()->valueOf());
        });
    }
}
