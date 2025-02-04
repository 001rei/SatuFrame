<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotografer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spesialisasi',
        'portofolio',
        'deskripsi',
        'floor_price',
        'kota',
        'foto_profil'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
