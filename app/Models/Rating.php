<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'rating',
        'benih_id'
    ];

    public function benih()
    {
        return $this->belongsTo(Benih::class);
    }
}
