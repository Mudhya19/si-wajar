<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'transaksi_id',
    //     'total_pendapatan',
    //     'pemasukan',
    //     'pengeluaran',
    //     'tanggal',
    //     'keterangan',
    //     'kendala',
    //     'solusi',
    // ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

}
