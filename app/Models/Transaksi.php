<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporan()
    {
        return $this->belongTo(Laporan::class);
    }

    public function masakan()
    {
        return $this->hasMany(Masakan::class);
    }
}
