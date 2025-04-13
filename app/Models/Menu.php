<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // protected $fillable = [
    //     'jenis_menu',
    //     'nama_menu',
    //     'photo',
    //     'satuan',
    //     'status',
    // ];

    public function masakan()
    {
        return $this->hasMany(Masakan::class);
    }
}
