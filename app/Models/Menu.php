<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
//     protected $fillable = [
//     'nama_menu',
//     'jenis_menu',
//     'satuan',
//     'status',
//     'photo'
// ];

    public function masakan()
    {
        return $this->belongTo(Masakan::class);
    }
}
