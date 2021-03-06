<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rekening',
        'gambar',
        'status',
        'rating',
        'seller_id',
    ];

    public function getImgAttribute()
    {
        return url('storage', $this->gambar);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

}
