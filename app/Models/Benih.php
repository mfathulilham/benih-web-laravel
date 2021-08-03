<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benih extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'gambar',
        'kategori',
        'varietas',
        'umur',
        'potensi',
        'rekomendasi',
        'deskripsi',
        'variasi',
        'stok',
        'harga',
        'terjual',
        'user_id'
    ];
    public function getImgAttribute()
    {
        return url('storage', $this->gambar);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
}
