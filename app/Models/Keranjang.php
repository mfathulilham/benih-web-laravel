<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $fillable = [
        'benih_id',
        'user_id',
        'jumlah',
        'total_harga',
        'transaksi_id',
        'status',
    ];

    protected $with = [
        'benih'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function benih()
    {
        return $this->belongsTo(Benih::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

}
