<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'keterangan',
        'slug'
    ];

    public $timestamps = true;

    public function arsipSurats()
    {
        return $this->hasMany(ArsipSurat::class, 'id_kategori', 'id_kategori');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            $kategori->slug = md5(now()->valueOf());
        });
    }
}
