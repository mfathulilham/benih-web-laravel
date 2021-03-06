<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_rekening',
        'nomor_rekening',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
