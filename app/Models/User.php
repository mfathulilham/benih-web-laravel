<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
// class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'telp',
        'password',
        'name',
        'email',
        'lahir',
        'alamat',
        'prov',
        'kab',
        'kec',
        'role',
        'otp',
        'confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'telp_verified_at' => 'datetime',
    ];

    // public function hasVerifiedPhone()
    // {
    //     return ! is_null($this->telp_verified_at);
    // }

    // public function markPhoneAsVerified()
    // {
    //     return $this->forceFill([
    //         'telp_verified_at' => $this->freshTimestamp(),
    //     ])->save();
    // }

    public function benihs()
    {
        return $this->hasMany(Benih::class);
    }

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
    public function rekenings()
    {
        return $this->hasMany(Rekening::class);
    }
}
