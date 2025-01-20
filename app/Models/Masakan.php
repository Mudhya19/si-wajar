<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masakan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
