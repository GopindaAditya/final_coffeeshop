<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produks extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable =[
        'name',
        'harga',
        'desc',
        'stok',
        'foto'
    ];
}
