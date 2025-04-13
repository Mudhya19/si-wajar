<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masakan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'menu_id',
    //     'transaksi_id',
    //     'harga_satuan',
    //     'jumlah_satuan',
    // ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

}
