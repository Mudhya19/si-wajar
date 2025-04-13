<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'user_id',
    //     'total_harga',
    //     'metode',
    //     'tanggal_transaksi',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function masakan()
    {
        return $this->hasMany(Masakan::class);
    }
}
